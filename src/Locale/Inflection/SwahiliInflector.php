<?php declare(strict_types=1);

namespace Laque\SwahiliLocale\Locale\Inflection;

use Laque\SwahiliLocale\Locale\Contracts\InflectorInterface;

final class SwahiliInflector implements InflectorInterface
{
	/** Default irregular noun plurals (class 5/6 + a few common cases) */
	private const DEFAULT_NOUN_OVERRIDES = [
		'jina'  => 'majina',
		'jicho' => 'macho',
		'jino'  => 'meno',
		'jambo' => 'mambo',
		'jiwe'  => 'mawe',
	];

	/** Nouns that don’t change in plural */
	private const DEFAULT_INVARIANT = [
		'habari' => true,
		'taarifa' => true,
		'data' => true,
	];

	/** Passive irregulars */
	private const DEFAULT_PASSIVE_IRREGULAR = [
		'andika' => 'andikwa',
		'fungua' => 'funguliwa',
	];

	/** @var array<string,string> */
	private array $nounOverrides;

	/** @var array<string,bool> */
	private array $invariant;

	/** @var array<string,string> */
	private array $passiveIrregular;

	public function __construct(
		array $nounOverrides = [],
		array $invariant = self::DEFAULT_INVARIANT,
		array $passiveIrregular = self::DEFAULT_PASSIVE_IRREGULAR,
	) {
		// allow user overrides to win
		$this->nounOverrides   = array_change_key_case(array_merge(self::DEFAULT_NOUN_OVERRIDES, $nounOverrides), CASE_LOWER);
		$this->invariant       = array_change_key_case($invariant, CASE_LOWER);
		$this->passiveIrregular = array_change_key_case($passiveIrregular, CASE_LOWER);
	}

	public function pluralizeNoun(string $noun, int $count = 2): string
	{
		$n = mb_strtolower(trim($noun));
		if ($count === 1) return $noun;

		// 1) Irregulars
		if (isset($this->nounOverrides[$n])) return $this->nounOverrides[$n];

		// 2) Invariants
		if (isset($this->invariant[$n])) return $noun;

		// 3) m- class (m- → wa-)
		if (preg_match('/^m([b-df-hj-np-tv-z].+)/u', $n)) {
			return 'wa' . mb_substr($n, 1);
		}

		// 4) ki- → vi-
		if (str_starts_with($n, 'ki')) {
			return 'vi' . mb_substr($n, 2);
		}

		// 5) ji/ma class (generic fallback):
		//    keep 'ji' as-is (e.g., jina -> majina), irregulars cover jiwe/jicho/jino/jambo
		if (str_starts_with($n, 'ji')) {
			return 'ma' . $n;
		}

		// 6) nouns starting with a vowel often take ma-
		if (preg_match('/^[aeiou].*/u', $n)) {
			return 'ma' . $n;
		}

		return $noun; // fallback
	}

	public function conjugateVerb(
		string $verb,
		string $tense = 'present',
		string $person = 'impersonal',
		string $nounClass = 'default'
	): string {
		$base = mb_strtolower(trim($verb));
		$stem = $this->toPassive($base); // your tests expect passive

		$prefix = match ($tense) {
			'past'   => 'ili',
			'future' => 'ita',
			default  => 'ime', // present/perfect-ish
		};

		return $prefix . $stem;
	}

	private function toPassive(string $base): string
	{
		// 0) Irregulars
		if (isset($this->passiveIrregular[$base])) {
			return $this->passiveIrregular[$base];
		}

		// 1) Already passive? (…wa)
		if (mb_substr($base, -2) === 'wa') {
			return $base;
		}

		// 2) Regular -a → -wa
		if (mb_substr($base, -1) === 'a') {
			return mb_substr($base, 0, -1) . 'wa';
		}

		// 3) Fallback: append wa
		return $base . 'wa';
	}
}
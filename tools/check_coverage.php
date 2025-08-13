<?php
// tools/check_coverage.php
// Usage: php tools/check_coverage.php clover.xml 80
$clover = $argv[1] ?? 'clover.xml';
$min = isset($argv[2]) ? (float)$argv[2] : (float)(getenv('COVERAGE_MIN') ?: 80);
if (!is_file($clover)) {
    fwrite(STDERR, "Clover file not found: $clover\n");
    exit(2);
}
$xml = simplexml_load_file($clover);
if (!$xml) {
    fwrite(STDERR, "Cannot parse clover: $clover\n");
    exit(2);
}
$metrics = $xml->project->metrics ?? $xml->metrics ?? null;
if (!$metrics) {
    fwrite(STDERR, "Metrics not found in clover: $clover\n");
    exit(2);
}
$statements = (int)$metrics['statements'];
$covered = (int)$metrics['coveredstatements'];
$rate = $statements > 0 ? ($covered / $statements) * 100 : 100.0;
$rateRounded = round($rate, 2);
echo "Line coverage: {$rateRounded}% (minimum {$min}%)\n";
if ($rate < $min) {
    fwrite(STDERR, "Coverage below minimum threshold.\n");
    exit(1);
}

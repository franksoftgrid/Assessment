<?php
function getPrimes($limit) {
	$is_primes = array_fill(2, $limit-1, true);
	
	for($i=2;$i<=$limit; $i++) {
		if($is_primes[$i]) {
			for($j=$i*$i; $j<=$limit; $j+=$i) {
				$is_primes[$j] = false;
			}
		}
	}
	$is_primes = array_filter($is_primes);
	return array_keys($is_primes);
}
$limit = 1000000;
$primes = getPrimes($limit);
$cons_prime_sum = 0;
$number_of_primes = 0;
$prime_sum = array(0);

for ($i = 0; $i < count($primes); $i++) {
    $prime_sum[$i+1] = $prime_sum[$i] + $primes[$i];
}

for ($i = $number_of_primes; $i < count($prime_sum); $i++) {
	for ($j = $i-($number_of_primes+1); $j >= 0; $j--) {
		if ($prime_sum[$i] - $prime_sum[$j] > $limit) break;
		if(array_search($prime_sum[$i] - $prime_sum[$j], $primes)) {
			$number_of_primes = $i - $j;
			$cons_prime_sum = $prime_sum[$i] - $prime_sum[$j];
		}
	}
}

echo $cons_prime_sum.' '.$number_of_primes;

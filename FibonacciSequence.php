<?php
/**
 * Per updated request for Fibonacci Sequence
 * Reference Calculus Early Transcendentals, Second Edition By Briggs, Cochran and Gilett
 * Pages 618 and 640
 */
class Fibonacci implements Countable {
    private $n = 0;
    private $n1 = null;
    private $steps = null;
    private $fibonacciNums = [];
    private $count = 0;
    
    /**
     * Will return the fibonacci sequence 1, 1, 2, 3, 5, 8
     * F(0) = 1, F(1) = 1, F(n) = F(n) + F(n-1), F(n) = n
     * @return array the Fibonacci sequence
     */
    public function getSequence() : array {
        if (empty($this->fibonacciNums)) {
            for ($i = 0; $i < $this->steps; $i++) {
                $this->fibonacciNums[] = $this->next($this->n, $this->n1, true);
                
                if ($i >= 1) {
                    $this->n1 = $this->fibonacciNums[$i-1];
                }
                
                $this->n = $this->fibonacciNums[$i];
            }
            $this->count = count($this->fibonacciNums);
        }
        return $this->fibonacciNums;
    }
    
    /** 
     * Gets the next number in the sequence
     * @param int $n - The current number in sequence
     * @param int $n1 - The previous number in sequence
     * @return int - the next number in the sequence
     */
    private function next(int $n, ?int $n1) : int {
        return ($n === 0 || ($n === 1 && $n1 === null) ? 1 : $n + $n1);
    }
    
    /**
     * Sets the steps paramater
     * @param string $name - parameter name
     * @param mixed $value - paramater value
     * @throws UnexpectedValueException
     */
    public function __set($name, $value) : void {
        switch($name) {
            case 'steps':
                $this->$name = intval($value);
                break;
            default:
                throw new UnexpectedValueException('Property is not able to be set or not found');
            break;
        }
    }
    
    /**
     * returns the count of fibonacciNums
     * @return int
     */
    public function count() : int {
        return $this->count;
    }
}

$n = new Fibonacci();

try {
    $n->steps = 20;
    var_dump($n->getSequence());
    echo count($n);
} catch(UnexpectedValueException $uve) {
    echo $uve->getMessage()."\n";
}


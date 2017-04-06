<?php


class Perceptron{
    protected $vectorLength;
    protected $bias;
    protected $learningRate;
    protected $weightVector;
    protected $iterations = 0;
    protected $errorSum = 0;
    protected $iterationError = 0;
    protected $output = null;

    public function __construct($neuronas, $bias = 0.0, $learningRate = .5){
        if ($neuronas < 1) {
            throw new \InvalidArgumentException();
        } elseif ($learningRate <= 0 || $learningRate > 1) {
            throw new \InvalidArgumentException();
        }
        $this->vectorLength = $neuronas;
        $this->bias = $bias;
        $this->learningRate = $learningRate;
        for ($i = 0; $i < $this->vectorLength; $i++) {
            $this->weightVector[$i] = rand()/getrandmax() * 2 - 1;
        }
    }
    public function getOutput(){
        if(is_null($this->output)) {
            throw new \RuntimeException();
        } else {
            return $this->output;
        }
    }
    public function getWeightVector(){
        return $this->weightVector;
    }

    public function setWeightVector($weightVector){
        if (!is_array($weightVector) || count($weightVector) != $this->vectorLength) {
            throw new \InvalidArgumentException();
        }
        $this->weightVector = $weightVector;
    }
    public function getBias(){
        return $this->bias;
    }
    public function setBias($bias){
        if (!is_numeric($bias)) {
            throw new \InvalidArgumentException();
        }
        $this->bias = $bias;
    }
    public function getLearningRate(){
        return $this->learningRate;
    }
    public function setLearningRate($learningRate){
        if (!is_numeric($learningRate) || $learningRate <= 0 || $learningRate > 1) {
            throw new \InvalidArgumentException();
        }
        $this->learningRate = $learningRate;
    }

    public function getIterationError(){
        return $this->iterationError;
    }

    public function clasifica($inputVector){
        if (!is_array($inputVector) || count($inputVector) != $this->vectorLength) {
            throw new \InvalidArgumentException();
        }
        $testResult = $this->dotProduct($this->weightVector, $inputVector) + $this->bias;
        $this->output = $testResult > 0 ? 1 : 0;
        return $this->output;
    }

    public function entrena($inputVector, $outcome){
        if (!is_array($inputVector) || !($outcome == 0 || $outcome == 1)) {
            throw new \InvalidArgumentException();
        }
        $this->iterations += 1;
        $output = $this->clasifica($inputVector);
        for ($i = 0; $i < $this->vectorLength; $i++) {
            $this->weightVector[$i] =
                $this->weightVector[$i] + $this->learningRate * ((int) $outcome - (int) $output) * $inputVector[$i];
        }
        $this->bias = $this->bias + ((int) $outcome - (int) $output);
        $this->errorSum += (int) $outcome - (int) $output;
        $this->iterationError = 1 / $this->iterations * $this->errorSum;
    }
    private function dotProduct($vector1, $vector2){
        return array_sum(
            array_map(
                function ($a, $b) {
                    return $a * $b;
                },
                $vector1,
                $vector2
            )
        );
    }
}
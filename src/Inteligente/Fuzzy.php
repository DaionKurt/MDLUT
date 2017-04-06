<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 10:01 AM
 */

require("Membrerias.php");

class Fuzzy{
    private $conjuntos_edad = array("Niño","Adolescente","Joven","Adulto","3ra Edad");
    private $conjuntos_glucosa = array("Baja","Normal","Alta","Muy alta");
    private $conjuntos_IMC = array("Insuficiente","Normal","Sobrepeso","Obesidad I","Obesidad II","Obesidad III");
    private $conjuntos_condicion_diabetico = array("No diabético","Pre-diabético","Diabético");
    private $nivs_mem_edad = array();
    private $nivs_mem_glucosa = array();
    private $nivs_mem_imc = array();
    private $nivs_mem_condicion = array();
    private $condiciones = array();

    public function inicializar(){
        for($i=0, $j=count($this->conjuntos_condicion_diabetico);$i<$j;$i++){
            $this->condiciones[$this->conjuntos_condicion_diabetico[$i]];
        }
    }
    public function posNivMemMay($nivs_mem){
        $pos=0;
        for($i=0,$j=count($nivs_mem);$i<$j;++$i){
            if($nivs_mem[$i]>$nivs_mem[$pos]){$pos=$i;}
        }
        return $pos;
    }
    public function muestraNivMemMay($msg,$nivs_mem){
        #echo $msg.": [";
        for($i=0,$j=count($nivs_mem);$i<$j;++$i){
        #    echo $nivs_mem[$i].($i+1==$j?"]":", ");
        }
        #echo "\n";
    }
    public function prodMembsEdad($dato_nitido){
        $this->nivs_mem_edad[0]=Membrerias::funcion_Z($dato_nitido,11,12);
        $this->nivs_mem_edad[1]=Membrerias::funcion_soft_pi($dato_nitido,11, 12, 19, 20);
        $this->nivs_mem_edad[2]=Membrerias::funcion_soft_pi($dato_nitido,19, 20, 25, 26);
        $this->nivs_mem_edad[3]=Membrerias::funcion_soft_pi($dato_nitido,25, 26, 59, 60);
        $this->nivs_mem_edad[4]=Membrerias::funcion_S($dato_nitido,59, 60);
        $this->muestraNivMemMay(("Membresías Edad=".$dato_nitido),$this->nivs_mem_edad);
    }
    public function prodMembsGlucosa($dato_nitido,$ayunas){
        if($ayunas){
            $this->nivs_mem_glucosa[0]=Membrerias::funcion_Z($dato_nitido,55, 70);
            $this->nivs_mem_glucosa[1]=Membrerias::funcion_soft_lambda($dato_nitido, 65, 85, 105);
            $this->nivs_mem_glucosa[2]=Membrerias::funcion_soft_lambda($dato_nitido, 85, 105, 120);
            $this->nivs_mem_glucosa[3]=Membrerias::funcion_S($dato_nitido,120, 135);
        }else{
            $this->nivs_mem_glucosa[0]=Membrerias::funcion_Z($dato_nitido,65, 70);
            $this->nivs_mem_glucosa[1]=Membrerias::funcion_soft_lambda($dato_nitido, 70, 110, 150);
            $this->nivs_mem_glucosa[2]=Membrerias::funcion_soft_lambda($dato_nitido, 110, 150, 200);
            $this->nivs_mem_glucosa[3]=Membrerias::funcion_S($dato_nitido,150, 200);
        }
        $this->muestraNivMemMay(("Membresías Glucosa=".$dato_nitido),$this->nivs_mem_glucosa);
    }
    public function prodMembsIMC($dato_nitido){
        $this->nivs_mem_imc[0]=Membrerias::funcion_Z($dato_nitido,18.4, 20);
        $this->nivs_mem_imc[1]=Membrerias::funcion_soft_pi($dato_nitido, 18.4, 20, 23, 25);
        $this->nivs_mem_imc[2]=Membrerias::funcion_soft_pi($dato_nitido, 23, 25, 28, 30);
        $this->nivs_mem_imc[3]=Membrerias::funcion_soft_pi($dato_nitido, 28, 30, 33, 35);
        $this->nivs_mem_imc[4]=Membrerias::funcion_soft_pi($dato_nitido, 33, 35, 38, 40);
        $this->nivs_mem_imc[5]=Membrerias::funcion_S($dato_nitido,38, 40);
        $this->muestraNivMemMay(("Membresías IMC=".$dato_nitido),$this->nivs_mem_imc);
    }
    public function fuzzificar_edad($dato_nitido){
        $this->prodMembsEdad($dato_nitido);
        return $this->conjuntos_edad[$this->posNivMemMay($this->nivs_mem_edad)];
    }
    public function fuzzificar_glucosa($dato_nitido,$ayunas){
        $this->prodMembsGlucosa($dato_nitido,$ayunas);
        return $this->conjuntos_glucosa[$this->posNivMemMay($this->nivs_mem_glucosa)];
    }
    public function fuzzificar_imc($dato_nitido){
        $this->prodMembsIMC($dato_nitido);
        return $this->conjuntos_IMC[$this->posNivMemMay($this->nivs_mem_imc)];
    }
    private function min($a,$b){return $a<$b?$a:$b;}
    private function max($a,$b){return $a>$b?$a:$b;}
    public function inferirCondicionDifusaCualitativo($edad,$glucosa,$imc){
        $condicionDifusa = "";
        if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Baja' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Normal' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Alta' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Alta' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Niño' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adolescente' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Joven' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='Adulto' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Insuficiente') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Normal') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Sobrepeso') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Obesidad I') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($glucosa==='Muy alta' & $edad==='3ra Edad' & $imc==='Obesidad III') $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        return $condicionDifusa;
    }
    public function inferirCondicionDifusaCuantitativo($edad,$glucosa,$imc){
		$nivMemEdad=$this->nivs_mem_edad[$this->posNivMemMay($this->nivs_mem_edad)];
		$nivMemGlucosa=$this->nivs_mem_glucosa[$this->posNivMemMay($this->nivs_mem_glucosa)];
        $nivMemIMC=$this->nivs_mem_imc[$this->posNivMemMay($this->nivs_mem_imc)];
        $nivMemCondicion=$this->min($this->min($nivMemGlucosa,$nivMemIMC),$nivMemEdad);
        $condicion=$this->inferirCondicionDifusaCualitativo($edad, $glucosa, $imc);
        $this->nivs_mem_condicion[array_search($condicion, $this->condiciones)]=$nivMemCondicion;
		return $this->nivs_mem_condicion[$this->posNivMemMay($this->nivs_mem_condicion)];
    }
    public function desfuzzificar($condicion_difusa,$niv_mem_condicion){
        switch ($condicion_difusa){
            case "No diabético": return $niv_mem_condicion*33;
            case "Pre-diabético": return $niv_mem_condicion*66;
            case "Diabético": return $niv_mem_condicion*100;
        }
        return 0.0;
    }
    public function getNivsMemCondicionDiabetico(){
        return $this->nivs_mem_condicion;
    }

}
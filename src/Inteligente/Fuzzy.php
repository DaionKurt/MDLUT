<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 10:01 AM
 */

namespace Inteligente;
require("Membrerias.php");

class Fuzzy{
    private $conjuntos_edad = array("Niño","Adolescente","Joven","Adulto","3ra Edad");
    private $conjuntos_glucosa = array("Baja","Ideal","Alta");
    private $conjuntos_aminoacidos = array("Bajo","Ideal","Alto");
    private $conjuntos_IMC = array("Bajo","Ideal","Sobrepeso","Obesidad");
    private $conjuntos_condicion_diabetico = array("No diabético","Pre-diabético","Diabético");
    private $nivs_mem_edad = array();
    private $nivs_mem_glucosa = array();
    private $nivs_mem_aminoacidos = array();
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
        echo $msg.": [";
        for($i=0,$j=count($nivs_mem);$i<$j;++$i){
            echo $nivs_mem[$i].($i+1==$j?"]":", ");
        }
        echo "\n";
    }
    public function prodMembsEdad($dato_nitido){
        $this->nivs_mem_edad[0]=Membrerias::funcion_Z($dato_nitido,11,12);
        $this->nivs_mem_edad[1]=Membrerias::funcion_soft_pi($dato_nitido,11, 12, 19, 20);
        $this->nivs_mem_edad[2]=Membrerias::funcion_soft_pi($dato_nitido,19, 20, 25, 26);
        $this->nivs_mem_edad[3]=Membrerias::funcion_soft_pi($dato_nitido,25, 26, 59, 60);
        $this->nivs_mem_edad[4]=Membrerias::funcion_S($dato_nitido,59, 60);
        $this->muestraNivMemMay(("Membresías Edad=".$dato_nitido),$this->nivs_mem_edad);
    }
    public function prodMembsGlucosa($dato_nitido){
        $this->nivs_mem_glucosa[0]=Membrerias::funcion_Z($dato_nitido,70, 115);
        $this->nivs_mem_glucosa[1]=Membrerias::funcion_soft_lambda($dato_nitido, 70, 115, 180);
        $this->nivs_mem_glucosa[2]=Membrerias::funcion_S($dato_nitido,115, 180);
        $this->muestraNivMemMay(("Membresías Glucosa=".$dato_nitido),$this->nivs_mem_glucosa);
    }
    public function prodMembsAminoacidos($dato_nitido){
        $this->nivs_mem_aminoacidos[0]=Membrerias::funcion_Z($dato_nitido,50, 80);
        $this->nivs_mem_aminoacidos[1]=Membrerias::funcion_soft_lambda($dato_nitido, 50, 80, 120);
        $this->nivs_mem_aminoacidos[2]=Membrerias::funcion_S($dato_nitido,80, 120);
        $this->muestraNivMemMay(("Membresías Aminoácidos=".$dato_nitido),$this->nivs_mem_aminoacidos);
    }
    public function prodMembsIMC($dato_nitido){
        $this->nivs_mem_imc[0]=Membrerias::funcion_Z($dato_nitido,18.4, 20);
        $this->nivs_mem_imc[1]=Membrerias::funcion_soft_pi($dato_nitido, 18.4, 20, 23, 25);
        $this->nivs_mem_imc[2]=Membrerias::funcion_soft_pi($dato_nitido, 23, 25, 27, 30);
        $this->nivs_mem_imc[3]=Membrerias::funcion_S($dato_nitido,27, 30);
        $this->muestraNivMemMay(("Membresías IMC=".$dato_nitido),$this->nivs_mem_imc);
    }
    public function fuzzificar_edad($dato_nitido){
        $this->prodMembsEdad($dato_nitido);
        return $this->conjuntos_edad[$this->posNivMemMay($this->nivs_mem_edad)];
    }
    public function fuzzificar_glucosa($dato_nitido){
        $this->prodMembsGlucosa($dato_nitido);
        return $this->conjuntos_glucosa[$this->posNivMemMay($this->nivs_mem_glucosa)];
    }
    public function fuzzificar_aminoacidos($dato_nitido){
        $this->prodMembsAminoacidos($dato_nitido);
        return $this->conjuntos_aminoacidos[$this->posNivMemMay($this->nivs_mem_aminoacidos)];
    }
    public function fuzzificar_imc($dato_nitido){
        $this->prodMembsIMC($dato_nitido);
        return $this->conjuntos_IMC[$this->posNivMemMay($this->nivs_mem_imc)];
    }
    private function min($a,$b){return $a<$b?$a:$b;}
    private function max($a,$b){return $a>$b?$a:$b;}
    public function inferirCondicionDifusaCualitativo($edad,$glucosa,$aminoacido,$imc){
        $condicionDifusa = "";
        if ($imc==="Bajo" & $edad==="Niño" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Adolescente" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Joven" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Adulto" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="3ra Edad" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Niño" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Adolescente" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Joven" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Adulto" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="3ra Edad" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Niño" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Adolescente" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Bajo" & $edad==="Joven" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Bajo" & $edad==="Adulto" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Bajo" & $edad==="3ra Edad" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];

        else if ($imc==="Ideal" & $edad==="Niño" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Adolescente" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Joven" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Adulto" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="3ra Edad" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Niño" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Adolescente" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Joven" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Adulto" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="3ra Edad" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Ideal" & $edad==="Niño" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Ideal" & $edad==="Adolescente" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Ideal" & $edad==="Joven" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Ideal" & $edad==="Adulto" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Ideal" & $edad==="3ra Edad" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];

        else if ($imc==="Sobrepeso" & $edad==="Niño" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Adolescente" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Joven" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Adulto" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="3ra Edad" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Niño" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Adolescente" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Sobrepeso" & $edad==="Joven" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Sobrepeso" & $edad==="Adulto" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Sobrepeso" & $edad==="3ra Edad" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Sobrepeso" & $edad==="Niño" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Sobrepeso" & $edad==="Adolescente" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Sobrepeso" & $edad==="Joven" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Sobrepeso" & $edad==="Adulto" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Sobrepeso" & $edad==="3ra Edad" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];

        else if ($imc==="Obesidad" & $edad==="Niño" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Obesidad" & $edad==="Adolescente" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Obesidad" & $edad==="Joven" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[0];
        else if ($imc==="Obesidad" & $edad==="Adulto" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="3ra Edad" & ($glucosa==="Baja" | $aminoacido === "Bajo"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="Niño" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="Adolescente" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="Joven" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="Adulto" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="3ra Edad" & ($glucosa==="Ideal" | $aminoacido === "Ideal"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[1];
        else if ($imc==="Obesidad" & $edad==="Niño" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Obesidad" & $edad==="Adolescente" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Obesidad" & $edad==="Joven" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Obesidad" & $edad==="Adulto" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        else if ($imc==="Obesidad" & $edad==="3ra Edad" & ($glucosa==="Alta" | $aminoacido === "Alto"))
            $condicionDifusa=$this->conjuntos_condicion_diabetico[2];
        return $condicionDifusa;
    }
    public function inferirCondicionDifusaCuantitativo($edad,$glucosa,$aminoacido,$imc){
		$nivMemEdad=$this->nivs_mem_edad[$this->posNivMemMay($this->nivs_mem_edad)];
		$nivMemGlucosa=$this->nivs_mem_glucosa[$this->posNivMemMay($this->nivs_mem_glucosa)];
        $nivMemAminoacidos=$this->nivs_mem_aminoacidos[$this->posNivMemMay($this->nivs_mem_aminoacidos)];
        $nivMemIMC=$this->nivs_mem_imc[$this->posNivMemMay($this->nivs_mem_imc)];
        $nivMemCondicion=$this->min($this->min($this->max($nivMemGlucosa,$nivMemAminoacidos),$nivMemIMC),$nivMemEdad);
        $condicion=$this->inferirCondicionDifusaCualitativo($edad, $glucosa, $aminoacido, $imc);
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
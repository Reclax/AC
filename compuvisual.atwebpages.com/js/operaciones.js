class suma{
    constructor(numero1,numero2){
        this.numero1=numero1;
        this.numero2=numero2;
    }
    sumarNumeros(){
        return this.numero1+this.numero2;
    }
}


function sumar(){
    var numero1=parseInt(document.getElementById("t").value);
    var numero2=parseInt(document.getElementById("t1").value);
    var objeto=new suma(numero1,numero2);
    document.getElementById("resultado").innerText="El resultado es: "+objeto.sumarNumeros();
}
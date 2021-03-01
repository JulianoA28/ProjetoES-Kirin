var btn_add = document.getElementById('add');
var form1 = document.getElementById('form1');
var box = document.getElementById('box');
var x = 1;

btn_add.addEventListener('click', function(){
	createLabel();
	createInput(x);
	createBr();
	x += 1;
});

function createLabel()
{
	var elemento = document.createElement('label');
	elemento.setAttribute('for', 'nome2');
	elemento.textContent = 'Livro: ';
	box.appendChild(elemento);
}

function createInput(x)
{
	var elemento = document.createElement('input');
	elemento.setAttribute('type', 'text');
	elemento.setAttribute('name', x);
	elemento.setAttribute('id', 'nome2');
	box.appendChild(elemento);
}

function createBr()
{
	var elemento = document.createElement('br');
	box.appendChild(elemento);
}
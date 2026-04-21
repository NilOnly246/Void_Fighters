<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title> Tabla de Puntuacions </title>
<style>
	html, body {
		background-color: #030A5C;
		margin: 0;
		padding: 0;
		overflow: hidden;
		height: 100%;
		font-family: Arial, sans-serif;
	}

	#fondo1, #fondo2 {
		position: absolute;
		width: 100%;
		height: 100%;
		background-image: url('fondo.png');
		background-size: cover;
		top: 0;
		left: 0;
		z-index: 0;
	}

	.container {
		position: relative;
		z-index: 1;
		background: rgba(255,255,255,0.0);
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0 4px 10px rgba(0,0,0,0.1);
		width: 60%;
		margin: 50px auto;
		text-align: center;
	}

	h2 {
		text-align: center;
	}

	#ranking div {
		margin-bottom: 10px;
	}

	img.letter {
		vertical-align: top;
	}

</style>
</head>
<body>

<div id="fondo1"></div>
<div id="fondo2"></div>

<div class="container">
	<div id="ranking"></div>
</div>
$puntuaciones = [];
<?php
if (($file = fopen("puntuaciones.csv", "r")) !== FALSE) {
	$first = true;
	while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
		if ($first) { $first = false; continue; }
		$puntuaciones[] = ["nombre"=>$data[0], "puntos"=>$data[1]];

	}
	fclose($file);
};
echo "<script>const puntuaciones = ".json_encode($puntuaciones, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE).";</script>";
?>

<script>
const letters = {
	"A": "caracteres/A.png", "B": "caracteres/B.png", "C": "caracteres/C.png",
	"D": "caracteres/D.png", "E": "caracteres/E.png", "F": "caracteres/F.png",
	"G": "caracteres/G.png", "H": "caracteres/H.png", "I": "caracteres/I.png",
	"J": "caracteres/J.png", "K": "caracteres/K.png", "L": "caracteres/L.png",
	"M": "caracteres/M.png", "N": "caracteres/N.png", "Ñ": "caracteres/Ñ.png",
	"O": "caracteres/O.png", "P": "caracteres/P.png", "Q": "caracteres/Q.png",
	"R": "caracteres/R.png", "S": "caracteres/S.png", "T": "caracteres/T.png",
	"U": "caracteres/U.png", "V": "caracteres/V.png", "W": "caracteres/W.png",
	"X": "caracteres/X.png", "Y": "caracteres/Y.png", "Z": "caracteres/Z.png",
	"-": "caracteres/-.png", "_": "caracteres/_.png", "~": "caracteres/~.png",
	"!": "caracteres/!.png", "0": "caracteres/0.png", "1": "caracteres/1.png",
	"2": "caracteres/2.png", "3": "caracteres/3.png", "4": "caracteres/4.png",
	"5": "caracteres/5.png", "6": "caracteres/6.png", "7": "caracteres/7.png",
	"8": "caracteres/8.png", "9": "caracteres/9.png",
	" ": null
};

function crearPalabras(palabra, tamaño, contenedor) {
	palabra =palabra.toUpperCase();
	contenedor.innerHTML = "";
	for (let letra of palabra) {
		if (letra === " ") {
			const span = document.createElement("span");
			span.style.display = "inline-block";
			span.style.width = tamaño + "px";
			contenedor.appendChild(span);
		} else if (letters[letra]) {
			const img = document.createElement("img");
			img.src = letters[letra];
			img.width = tamaño;
			img.height = tamaño;
			img.className = "letter";
			img.style.marginRight = "-1px";
			contenedor.appendChild(img);
		}
	}
}

const contenedor = document.getElementById("ranking");
puntuaciones.forEach((p) => {
	const div = document.createElement("div");
	crearPalabras(`${p.nombre} ${p.puntos}`, 120, div);
	contenedor.appendChild(div);
});


const fondo1 = document.getElementById('fondo1');
const fondo2 = document.getElementById('fondo2');
const velocidad = 2;
let y1 = 0;
let y2 = -window.innerHeight;

function moverFondo() {
	y1 += velocidad;
	y2 += velocidad;

	if (y1 >= window.innerHeight)y1 = -window.innerHeight;
	if (y2 >= window.innerHeight)y2 = -window.innerHeight;

	fondo1.style.top = y1 + 'px';
	fondo2.style.top = y2 + 'px';

	requestAnimationFrame(moverFondo);
}

moverFondo();

window.addEventListener('resize', () => {
	y1 = 0;
	y2 = -window.innerHeight;
});
</script>

</body>
</html>

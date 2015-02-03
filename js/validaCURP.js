function validaCURP(curp) { 
	var paso = validateCURP(curp);

	if(!paso)
		alert("La CURP " + curp + " es incorrecta");

	return paso;
}

function validateCURP(curp) { 
  var expreg = /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}((0[13578]|1[02])(0[1-9]|1[0-9]|2[0-9]|3[0-1])|(0[469]|11)(0[1-9]|1[0-9]|2[0-9]|30)|(02)(0[1-9]|1[0-9]|2[0-9]))[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/;

  return expreg.test(curp);
}

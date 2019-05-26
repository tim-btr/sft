function G(param) {
	return typeof param == ('object') ? param : document.getElementById(param);
}

function S(param){
	return G(param).style;
}

function showModal(param){
	S(param).display = 'inline-block'; 
}

function hideModal(param) {
	S(param).display = 'none';
}

function authSubm(log, pass) {
	var logLen  = G(log);
	var passLen = G(pass);
	var logOk;
	var passOk; 

	if(logLen.value.length < 2 || logLen.value.length > 12) {
		S(log).border = '1px solid red';
		G('log-notice').innerHTML = 'Некорректная длина';
		logOk = false;
	} else {
		S(log).border = '1px solid black';
		G('log-notice').innerHTML = '';
	}

	if(passLen.value.length < 3 || passLen.value.length > 8) {
		S(pass).border = '1px solid red';
		G('pass-notice').innerHTML = 'Некорректная длина';
		passOk = false;
	} else {
		S(pass).border = '1px solid black';
		G('pass-notice').innerHTML = '';
	}

	if(false == logOk || false == passOk) {
		return false;
	} else {
		return true;
	}
}

function regSubm(par1, par2, par3, par4) {
	var lenLog  = G(par1);
	var lenPass = G(par2);
	var lenName = G(par3);
	var lenMail = G(par4);
	if(lenLog.value.length < 2 || lenLog.value.length > 12) {
		S(par1).border = '1px solid red';
		return false;
	} else if(lenPass.value.length < 3 || lenPass.value.length > 8) {
		S(par2).border = '1px solid red';
		return false;
	} else if(0 == lenName.value.length) {
		S(par3).border = '1px solid red';
		return false;
	} else if(0 == lenMail.value.length) {
		S(par3).border = '1px solid red';
		return false;
	} else {
		return true;
	}
}

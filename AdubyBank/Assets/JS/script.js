function toggleMenu(){
	if(document.getElementById("desktop_view").style.display == "none"){
		document.getElementById("desktop_view").style.display = "block";
	}
	else{
		document.getElementById("desktop_view").style.display = "none";
	}
}

function dropMenu(x){
	document.getElementById("acct_module").style.display = "none";
	document.getElementById("trxns").style.display = "none";
	document.getElementById("admin").style.display = "none";

	if(x == "1"){
		document.getElementById("acct_module").style.display = "block";
	}
	else if(x == "2"){
		document.getElementById("trxns").style.display = "block";
	}
	else if(x =="3"){
		document.getElementById("admin").style.display = "block";
	}
}

function logout(){
	window.location.replace("process/signout.php");
}

function idleLogoutCheck(){
	const t = 10000;
	setInterval(logout,t);
}

function clearTimeOut(){
	
}

function openPage(x){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function (){
		if(this.readyState == 4  && this.status == 200){
			document.getElementById('dashboard_content').innerHTML = this.responseText;
		}
	};
	if(x == "acctopen"){
		xhttp.open("GET","pages/onboarding.php",true);
	}
	if(x == "acctdet"){
		xhttp.open("GET","pages/accountdetails.php",true);
	}
	if(x == "acctbal"){
		xhttp.open("GET","pages/checkbalance.php",true);
	}
	if(x == "acctstat"){
		xhttp.open("GET","pages/accountstatement.php",true);
	}
	if(x == "acctclose"){
		xhttp.open("GET","pages/closeaccount.php",true);
	}
	if(x == "acctdep"){
		xhttp.open("GET","pages/deposit.php",true);
	}
	if(x == "acctwith"){
		xhttp.open("GET","pages/withdrawal.php",true);
	}
	if(x == "accttrsf"){
		xhttp.open("GET","pages/transfer.php",true);
	}
	if(x == "acctcreate"){
		xhttp.open("GET","pages/newstaff.php",true);
	}
	if(x == "acctman"){
		xhttp.open("GET","pages/managestaff.php",true);
	}
	if(x == "acctdel"){
		xhttp.open("GET","pages/deletestaff.php",true);
	}
	xhttp.send();
}

function confirmKYC(){
	if(document.getElementById("kyc").selectedIndex == "1"){
		document.getElementById("fgroup").style.display = "block";
		document.getElementById("kyc").disabled = true;
	}
	else{
		document.getElementById("fgroup").style.display = "none";	
		document.getElementById("kyc").disabled = false;
		alert("KYC must be confirmed OK before onboarding Customer");
	}
}

function getAccountNumber(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function (){
		if(this.readyState == 4  && this.status == 200){
			document.getElementById('acct_number').value = this.responseText;
		}
	};
	xhttp.open("GET","process/generateAccountNumber.php", true);
	xhttp.send();
}

function activateBtn(input,button){
	var accountnum = document.getElementById(input).value;
	if(accountnum.length == 10){
		document.getElementById(button).disabled = false;
	}
	else{
		document.getElementById(button).disabled = true;
	}
}

function getAcctDet(){
	var accountnum = document.getElementById("acct_num").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById("details").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET","process/getacctdetails.php?acctnum="+accountnum, true);
	xhttp.send();
}

function getStatement(){
	var accountnum = document.getElementById("acct_num").value;
	var from = document.getElementById("from").value;
	var to = document.getElementById("to").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById("statement").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET","process/getStatement.php?acctnum="+accountnum+"&from="+from+"&to="+to, true);
	xhttp.send();
}

function getTrxnDetails(x){
	var accountnum = document.getElementById("acctnum").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById("cusdetails").innerHTML = this.responseText;
		}
		if(this.readyState = 4 && this.status == 404){
			 document.write("Error 404! The Remote Server Page Missing");
		}
	};
	if(x == "getdepositor"){
		xhttp.open("GET","process/getdepdetails.php?acctnum="+accountnum, true);
	}
	else if(x == "getwithdrawer"){
		xhttp.open("GET","process/getwithdetails.php?acctnum="+accountnum, true);
	}
	else if(x == "gettransfer"){
		xhttp.open("GET","process/gettrsfdetails.php?acctnum="+accountnum, true);
	}
	
	xhttp.send(); 
}

function processTrxn(trxn){
	var inputs = document.getElementsByTagName("input");
	var accountnum = document.getElementById("acctnum").value;
	if(trxn == "depositcash"){
		var narration = "Depositor: "+ document.getElementById("depositor").value +
		" | " + document.getElementById("narration").value;
	}
	else if(trxn == "withdcash"){
		var beneficiary = document.getElementById("withdrawer").value;
		var balb4 = document.getElementById("balb4with").innerHTML;
		var narration = "Beneficiary: "+ document.getElementById("withdrawer").value +
		" | " + document.getElementById("narration").value;
	}
	else if(trxn == "transfer"){
		var benacctnum = document.getElementById("benacctnum").value;
		var beneficiary = document.getElementById("benacctname").value;
		var acctowner = document.getElementById("acctowner").innerHTML;
		var balb4 = document.getElementById("balb4trsf").innerHTML;
		var narration1 = "Beneficiary: "+ document.getElementById("benacctname").value +
		" | " + document.getElementById("narration").value;	
		var narration2 = "Recieved From: "+ acctowner +
		" | " + document.getElementById("narration").value;

	}
	for(i = 0; i<inputs.length;i++){
		if(inputs[i].value == ""){
			alert("This field can not be empty");
			inputs[i].style.borderColor = 'red';
			inputs[i].style.backgroundColor = 'lightgrey';
			inputs[i].focus();
			break;
		}
	}
	var amount = parseInt(document.getElementById("amount").value);
	if(typeof(amount) == NaN){
		alert("Amount Field Must Be a Number");
		document.getElementById("amount").focus();
	}
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(trxn == "depositcash"){
					document.getElementById("balafterdep").innerHTML = this.responseText;
					document.getElementById('amount').disabled = true;
					document.getElementById('depositor').disabled = true;
					document.getElementById('narration').disabled = true;
					document.getElementById('depositcash').disabled = true;
					alert(amount + ' cash Deposit made Successfully');
				}
				else if(trxn == "withdcash"){
					document.getElementById("balafterwith").innerHTML = this.responseText;
					document.getElementById('amount').disabled = true;
					document.getElementById('withdrawer').disabled = true;
					document.getElementById('narration').disabled = true;
					document.getElementById('withdcash').disabled = true;
					if(amount < balb4){
						alert(amount + ' cash paid Successfully to ' + beneficiary);
					}
					else{
						alert("Account balance insufficient for this withdrawal");
						document.getElementById('amount').style.color = 'red';
						document.getElementById('amount').focus();
						document.getElementById("balb4with").style.color = 'red';
					}
				}
				else if(trxn == "transfer"){
					if(this.responseText == "Account Closed"){
						document.getElementById('narration').disabled = true;
						document.getElementById('transfer').disabled = true;
					}
					else{
						document.getElementById("balaftertrsf").innerHTML = this.responseText;
						document.getElementById('amount').disabled = true;
						document.getElementById('benacctname').disabled = true;
						document.getElementById('narration').disabled = true;
						document.getElementById('transfer').disabled = true;
						if(amount < balb4){
							alert(amount + ' transfered Successfully to ' + beneficiary);
							document.getElementById("acctnum").focus();
						}
						else{
							alert("Account balance insufficient for this transfer");
							document.getElementById('amount').style.color = 'red';
							document.getElementById('amount').focus();
							document.getElementById("balb4trsf").style.color = 'red';
						}
					}
				} 
			}
		};
		if(trxn == "depositcash"){
			xhttp.open("GET","process/cashdeposit.php?acctnum="+accountnum+"&amount="+amount+
				"&narration="+ narration, true);
		}
		else if(trxn == "withdcash"){
			xhttp.open("GET","process/cashwithd.php?acctnum="+accountnum+"&amount="+amount+
				"&narration="+ narration, true);
		}
		else if(trxn == "transfer"){
			xhttp.open("GET","process/processtransfer.php?acctnum="+accountnum+"&benacctnum="+benacctnum+
				"&amount="+amount+"&narration1="+narration1+"&narration2="+narration2, true);
		}
		xhttp.send(); 
	}

}

function getBeneficiary(x){
	var account = document.getElementById(x).value;
	if(account.length == 10){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 & this.status == 200){
				document.getElementById("benacctname").value = this.responseText;
				document.getElementById("benacctname").style.color='black';
				document.getElementById("benacctname").style.fontStyle = 'normal';
				document.getElementById("narration").focus();
			}
		};

		xhttp.open("GET","process/getbeneficiary.php?acct="+account,true);
		xhttp.send();
	}
	else if(account.length > 10){
		document.getElementById("benacctname").value = "invalid account";
		document.getElementById("benacctname").style.color='red';
		document.getElementById("benacctname").style.fontStyle = 'italic';
	}
	else{
		document.getElementById("benacctname").value = "";
	} 
} 

function convertToExcel(type,fn,dl){
	var elt = document.getElementById("statementtable");
	var wb = XLSX.utils.table_to_book(elt,{sheet:"sheet1"});alert(type + "2");
	return dl ?
		XLSX.write(wb,{bookType: type, bookSST: true, type: "base64"}):
		XLSX.write(wb, fn || ("MyShhetName." + (type || "xlsx")));
		alert(type + "2");
}

function activateButton(x){
	if(x == "tellertype"){
		if(document.getElementById(x).selectedIndex > 0){
			document.getElementById("salute").focus();
		}
		else{
			alert("You Must choose a Teller Type");
			document.getElementById(x).focus();			
		}
	}
	else if(x == "salute"){
		if(document.getElementById(x).selectedIndex > 0){
			document.getElementById("tfname").focus();
		}
		else{
			alert("You Must choose a Title");
			document.getElementById(x).focus();			
		}
	}
	else if(x == "tgender"){
		if(document.getElementById(x).selectedIndex > 0){
			document.getElementById("temail").focus();
			document.getElementById("submitbtn").disabled = false;
		}
		else{
			alert("You Must choose a Gender");
			document.getElementById(x).focus();
			document.getElementById("submitbtn").disabled = true;	
		}
	}
}

function activateRetrieve(){

	var acctnum = document.getElementById("accountnumber").value;
	if(acctnum.length == 10){
		document.getElementById("retrievebtn").disabled = false;
	}
	else{
		document.getElementById("retrievebtn").disabled = true;
	}
}

function getAccountDetails(){
	var xhttp = new XMLHttpRequest();
	var acctnum = document.getElementById("accountnumber").value;
	xhttp.onreadystatechange = function (){
		if(this.readyState == 4  && this.status == 200){
			document.getElementById("accountdetails").innerHTML = this.responseText;
			document.getElementById("closethisaccount").style.display = "block";
		}
	};
	xhttp.open("GET","process/getacctdetails.php?acctnum="+acctnum,true);
	xhttp.send();
}

function closeAccount(){
	var xhttp = new XMLHttpRequest();
	var acctnum = document.getElementById("accountnumber").value;
	xhttp.onreadystatechange = function (){
		if(this.readyState == 4  && this.status == 200){
			document.getElementById("closureoutput").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET","process/closeaccount.php?acctnum="+acctnum,true);
	xhttp.send();
}
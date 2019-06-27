var i = 0; /* Set Global Variable i */
var col = "col-md-3 col-sm-3";
var type = [];
var typeUsePush = 0;

function increment(){
	i += 1; /* Function for automatic increment of field's "Name" attribute. */
}
/*
---------------------------------------------

Function to Remove Form Elements Dynamically
---------------------------------------------

*/
function removeElement(parentDiv, childDiv){
	if (childDiv == parentDiv){
		alert("The parent div cannot be removed.");
	}
	else if (document.getElementById(childDiv)){
		var child = document.getElementById(childDiv);
		var parent = document.getElementById(parentDiv);
		parent.removeChild(child);
	}
	else{
		alert("Child div has already been removed or does not exist.");
		return false;
	}
}

function txtFunction(){
	increment();
	var a = document.createElement('div');
	var b = document.createElement('div');
	var c = document.createElement('div');
	var d = document.createElement('div');
	var y = document.createElement("INPUT");
	var x = document.createElement("INPUT");
	var z = document.createElement("INPUT");
	var box = document.createElement("INPUT");
	var g = document.createElement("button");

	setAttributes(a,{"class":"row","id":"id_" + i});
	setAttributes(b,{"class":col});
	setAttributes(c,{"class":col});
	setAttributes(d,{"class":col});
	setAttributes(x,{"name":"ref_code[]","type":"text","class":"form-control","placeholder":"รหัสอ้างอิง"});
	setAttributes(y,{"name":"box_name[]","type":"text","class":"form-control","placeholder": "Placeholder"});
	setAttributes(z,{"name":"api_code[]","type":"text","class":"form-control","placeholder":"Function"});
	setAttributes(box,{"name":"box_type[]","type":"hidden","value":"txtbox"});
	setAttributes(g,{"type":"button","class":"btn btn-danger fa fa-times","onclick":"removeElement('myForm','id_" + i + "')"});

	b.appendChild(x);
	c.appendChild(y);
	d.appendChild(z);

	a.appendChild(b);
	a.appendChild(c);
	a.appendChild(d);
	a.appendChild(box);
	a.appendChild(g);

	document.getElementById("myForm").appendChild(a);
	typeUsePush=type.push("txtbox");
	document.getElementById('boxTYPE').value = type;
	document.getElementById('counter').value = typeUsePush;
}

function setAttributes(el, attrs) {
	for(var key in attrs) {
		el.setAttribute(key, attrs[key]);
	}
}

function resetElements(){
	document.getElementById('myForm').innerHTML = '';
}

var approveCounter = 0;

function counterFunction(){
	approveCounter+=1;
	subformFunction(approveCounter);
}

function subformFunction(approveCounter){
	var a = document.createElement('div');
	setAttributes(a,{"id":"subForm_"+approveCounter,"class":"form-group"});
	document.getElementById("myForm").appendChild(a);
	approveFunction(approveCounter);
}

function approveFunction(approveCounter){

	increment();
	var a = document.createElement('div');
	var b = document.createElement('div');
	var c = document.createElement('div');

	var btn = document.createElement("a");
	var btn_txt = document.createTextNode("เพิ่มผู้พิจารณา");

	var d = document.createElement("select");
	var opt1 = document.createElement("OPTION");
	var opt2 = document.createElement("OPTION");
	var opt3 = document.createElement("OPTION");

	var list1 = document.createTextNode("เรียงลำดับ");
	var list2 = document.createTextNode("ไม่เรียงลำดับ");
	var list3 = document.createTextNode("สำรอง");

	var e = document.createElement('div');

	setAttributes(a,{"class":"panel-body"});
	setAttributes(b,{"class":"row"});
	setAttributes(c,{"class":"col-md-3 col-sm-3"});
	setAttributes(d,{"name":"orderTYPE[]","class":"form-control pointer"});
	setAttributes(btn,{"onclick":"selectApprove("+approveCounter+")","class":"btn btn-3d btn-green btn-block btn-reveal"});
	setAttributes(e,{"class":"col-md-6 col-sm-6","id":"selectApprove"+approveCounter});

	opt3.appendChild(list3);
	opt2.appendChild(list2);
	opt1.appendChild(list1);

	d.appendChild(opt1);
	d.appendChild(opt2);
	d.appendChild(opt3);

	btn.appendChild(btn_txt);

	c.appendChild(btn);
	c.appendChild(d);

	b.appendChild(c);
	b.appendChild(e);
	a.appendChild(b);

	document.getElementById("subForm_"+approveCounter).appendChild(a);
}

function selectApprove(approveCounter){
	var d = document.createElement("select");
	var opt1 = document.createElement("OPTION");
	var opt2 = document.createElement("OPTION");
	var opt3 = document.createElement("OPTION");

	var list1 = document.createTextNode("อาจารย์ที่ปรึกษา");
	var list2 = document.createTextNode("หัวหน้าภาค");
	var list3 = document.createTextNode("คณบดี");

	setAttributes(d,{"class":"form-control pointer","name":"approve[]"});

	opt3.appendChild(list3);
	opt2.appendChild(list2);
	opt1.appendChild(list1);

	d.appendChild(opt1);
	d.appendChild(opt2);
	d.appendChild(opt3);

	document.getElementById("selectApprove"+approveCounter).appendChild(d);
}


//=============================================

function acceptorFunction(){

	increment();
	var a = document.createElement('div');
	var b = document.createElement('div');

	var y = document.createElement("select");

	var opt1 = document.createElement("OPTION");
	var opt2 = document.createElement("OPTION");
	var opt3 = document.createElement("OPTION");
	var opt4 = document.createElement("OPTION");

	var list1 = document.createTextNode("อาจารย์ที่ปรึกษา");
	var list2 = document.createTextNode("หัวหน้าภาควิชา");
	var list3 = document.createTextNode("งานบริการการศึกษา");
	var list4 = document.createTextNode("คณบดี");

	var g = document.createElement("button");

	setAttributes(a,{"class":"row","id":"id_" + i});
	setAttributes(b,{"class":"col-md-5 col-sm-5"});
	setAttributes(y,{"class":"col-md-12 col-sm-12"});

	setAttributes(y,{"name":"accept_value[]"});
	setAttributes(opt1,{"value":"001"});
	setAttributes(opt2,{"value":"002"});
	setAttributes(opt3,{"value":"003"});
	setAttributes(opt4,{"value":"004"});
	setAttributes(g,{"type":"button","class":"btn btn-danger fa fa-times","onclick":"removeElement('myForm','id_" + i + "')"});

	opt1.appendChild(list1);
	opt2.appendChild(list2);
	opt3.appendChild(list3);
	opt4.appendChild(list4);

	y.appendChild(opt1);
	y.appendChild(opt2);
	y.appendChild(opt3);
	y.appendChild(opt4);

	b.appendChild(y);
	a.appendChild(b);
	a.appendChild(g);


	document.getElementById("myForm").appendChild(a);

}


function deanFunction(){

	increment();
	var a = document.createElement('div');
	var b = document.createElement('div');

	var y = document.createElement("select");

	var opt1 = document.createElement("OPTION");
	var opt2 = document.createElement("OPTION");
	var opt3 = document.createElement("OPTION");
	var opt4 = document.createElement("OPTION");

	var list1 = document.createTextNode("อาจารย์ที่ปรึกษา");
	var list2 = document.createTextNode("หัวหน้าภาควิชา");
	var list3 = document.createTextNode("งานบริการการศึกษา");
	var list4 = document.createTextNode("คณบดี");

	var g = document.createElement("button");

	setAttributes(a,{"class":"row","id":"id_" + i});
	setAttributes(b,{"class":"col-md-5 col-sm-5"});
	setAttributes(y,{"class":"col-md-12 col-sm-12"});

	setAttributes(y,{"name":"dean[]"});
	setAttributes(opt1,{"value":"001"});
	setAttributes(opt2,{"value":"002"});
	setAttributes(opt3,{"value":"003"});
	setAttributes(opt4,{"value":"004"});
	setAttributes(g,{"type":"button","class":"btn btn-danger fa fa-times","onclick":"removeElement('myForm','id_" + i + "')"});

	opt1.appendChild(list1);
	opt2.appendChild(list2);
	opt3.appendChild(list3);
	opt4.appendChild(list4);

	y.appendChild(opt1);
	y.appendChild(opt2);
	y.appendChild(opt3);
	y.appendChild(opt4);

	b.appendChild(y);
	a.appendChild(b);
	a.appendChild(g);


	document.getElementById("myForm").appendChild(a);

}


function req_prop(){
						var name = document.getElementById('name').value;
						document.getElementById('req_name').value = name;

						var type = document.getElementById('type').value;
						document.getElementById('req_type').value = type;
					}

					function form_submit(){
						document.getElementById("mainform").submit();


					}

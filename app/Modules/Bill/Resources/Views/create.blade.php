var bill = angular.module('app', []);
bill.controller('BillController', BillController);

function BillController($scope, $http) {


$( document.body ).click(function() {
$scope.calculateBill();
});

$http
.get("http://localhost:8000/api/manual-journal/contact-account-tax-name", {
transformRequest: angular.identity,
headers: {'Content-Type': undefined, 'Process-Data': false}
})
.then(function(response){
item = response.data.item;
contact = response.data.contact;
tax = response.data.tax;
account = response.data.account;

$('#item_id_0').kendoDropDownList({
optionLabel   : "Select Item",
dataTextField: "text",
dataValueField: "value",
dataSource: item,
dataType: "jsonp",
index: 0
});

$('#tax_id_0').kendoDropDownList({
dataTextField: "text",
dataValueField: "value",
dataSource: tax,
dataType: "jsonp",
index: 0
});

$('#account_id_0').kendoDropDownList({
dataTextField: "text",
dataValueField: "value",
dataSource: account,
dataType: "jsonp",
index: 0
});

var dropdownlist = $("#account_id_0").data("kendoDropDownList");
dropdownlist.value(26);

});


$scope.bills = [];

$scope.Append = function () {

$scope.bills.push($scope.bills.length);
var i = $scope.bills.length;

$http
.get("http://localhost:8000/api/manual-journal/contact-account-tax-name", {
transformRequest: angular.identity,
headers: {'Content-Type': undefined, 'Process-Data': false}
})
.then(function(response){
item = response.data.item;
contact = response.data.contact;
tax = response.data.tax;
account = response.data.account;


$('#item_id_' +i).kendoDropDownList({
optionLabel   : "Select Item",
dataTextField: "text",
dataValueField: "value",
dataSource: item,
dataType: "jsonp",
index: 0
});

$('#tax_id_' + i).kendoDropDownList({
dataTextField: "text",
dataValueField: "value",
dataSource: tax,
dataType: "jsonp",
index: 0
});

$('#account_id_' + i).kendoDropDownList({
dataTextField: "text",
dataValueField: "value",
dataSource: account,
dataType: "jsonp",
index: 0
});

var dropdownlist = $("#account_id_" + i).data("kendoDropDownList");
dropdownlist.value(26);

});
}


$scope.Remove = function (index) {
$scope.bills.splice(index, 1);
}



$scope.getItemRate = function (index) {
console.log(index);

var item_id = $("#item_id_" + index).data("kendoDropDownList").value();
$http
.get("http://localhost:8000/api/bill/get-item-rate/" + item_id, {
transformRequest: angular.identity,
headers: {'Content-Type': undefined, 'Process-Data': false}
})
.then(function(response){
item_rate = response.data.item_rate;
$scope.rate[index] = item_rate;

})
.finally(function () {
$scope.calculateBill();
});

}


$scope.calculateBill = function () {
$scope.tax_total = 0.00;
var total_amount1 = 0.00;
var tax1 = 0.00;
var sub_total1 = 0.00;
var quantity,rate;
for(var i = 0; i <= $scope.bills.length; i++)
{
var tax = $("#tax_id_" + i + " option:selected").text();
var tax = tax.replace('%-tax', '');

if(!tax)
{
tax = 0.00;
}

if(isNaN($scope.quantity[i]))
{
quantity = 0.00;
}
else
{
quantity = $scope.quantity[i];
}

if(isNaN($scope.rate[i]))
{
rate = 0.00;
}
else
{
rate = $scope.rate[i];
}

var price = parseFloat(quantity)*parseFloat(rate);
$scope.amount[i] =  parseFloat(price);
sub_total1 = sub_total1 + $scope.amount[i];
tax1 = tax1 + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);
}

$scope.sub_total = parseFloat(sub_total1);
$scope.tax_total = parseFloat(tax1);

$scope.total_amount =parseFloat(sub_total1) + parseFloat(tax1);
}
}
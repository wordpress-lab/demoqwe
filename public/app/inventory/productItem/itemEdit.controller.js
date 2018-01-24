item.controller('ItemController', ItemController);
function ItemController($q, $scope, $http) {

    var item_id = document.getElementsByName('item_id')[0].value;

    $http
        .get(window.location.origin + "/api/product-track/get-product-phase-item/" + item_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            data = response.data.item_category;
            $scope.items = response.data.data;

        });

    $http
        .get(window.location.origin + "/api/product-track/get-product-phase-item/" + item_id, {
            transformRequest: angular.identity,
            headers: {
                'Content-Type': undefined,
                'Process-Data': false
            }
        })
        .then(function(response) {
            data = response.data.item_category;
            $scope.items = response.data.data;
            $scope.fullArr = []
            var i = 0;
            var a = 0;
            angular.forEach($scope.items, function(item) {

                $('#item_category_id_' + i++).kendoDropDownList({
                    optionLabel: "Select Category",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: data,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                })

                var dropdownlist = $("#item_category_id_" + a++).data("kendoDropDownList");
                dropdownlist.value(item.item_category_id);

                $scope.fullArr.push($http
                    .get("http://localhost:8000/api/item/get-item-name/" + item.item_category_id, {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    }));
            });
            sendReq()
        });

    function sendReq() {
        var i = 0;
        var a = 0
        var b = 0;
        $q.all($scope.fullArr).then(function(response) {
            angular.forEach(response, function(item) {
                data = item.data;
                var item_id = $scope.items[b++].item_id;
                $('#item_id_' + i++).kendoDropDownList({
                    optionLabel: "Select Item",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: data,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                var dropdownlist = $("#item_id_" + a++).data("kendoDropDownList");
                dropdownlist.value(item_id);

            });
        });
    }

    $scope.Append = function() {
        $scope.items.push($scope.items.length);
        console.log($scope.items);

        var i = $scope.items.length - 1 ;
        console.log(i);

        $http
            .get(window.location.origin + "/api/item/get-item-category-name", {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                data = response.data;


                $('#item_category_id_' +i).kendoDropDownList({
                    optionLabel   : "Select Category",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: data,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#item_id_' + i).kendoDropDownList({
                    optionLabel   : "Select Item"

                });

            });
    }

    $scope.Remove = function(index) {
        $scope.items.splice(index, 1);
    }

    $scope.getItem = function (index) {

        var value = $("#item_category_id_" + index).data("kendoDropDownList").value();

        $http
            .get(window.location.origin + "/api/item/get-item-name/" + value, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                data = response.data;
                $('#item_id_' + index).kendoDropDownList({
                    optionLabel   : "Select Item",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: data,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

            });
    }
}
item.controller('ItemController', ItemController);

function ItemController($scope, $http) {

    $http
        .get(window.location.origin + "/api/item/get-item-category-name", {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            data = response.data;
            $('#item_category_id_0').kendoDropDownList({
                optionLabel   : "Select Category",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: data,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

        });

    $('#item_id_0').kendoDropDownList({
        optionLabel   : "Select Item"
    });



    $scope.items = [];

    $scope.Append = function() {
        $scope.items.push($scope.items.length);

        var i = $scope.items.length;

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
        console.log(index);
        $scope.items.splice(index, 1);
        console.log($scope.items);
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
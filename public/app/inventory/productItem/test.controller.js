item.controller('ItemController', ItemController);
function ItemController($q, $scope, $http) {

    $scope.items = [{"id":1,"item_category_id":2,"item_id":7},
        {"id":2,"item_category_id":4,"item_id":22},
        {"id":3,"item_category_id":5,"item_id":9},
        {"id":4,"item_category_id":2,"item_id":7},
        {"id":5,"item_category_id":5,"item_id":9},
        {"id":6,"item_category_id":5,"item_id":9},
        {"id":7,"item_category_id":4,"item_id":12},
        {"id":8,"item_category_id":4,"item_id":12}]



    $scope.Append = function() {
        $scope.items.push($scope.items.length);
        console.log($scope.items);
    }

    $scope.Remove = function(index) {
        console.log(index);
        var item = $scope.items[index];
        removeItem(item);
    }


}
var contact = angular.module('app', []);
contact.controller('ContactController', ContactController);

function ContactController($scope, $http) {

    $http
        .get(window.location.origin + "/api/contact/get-contact-category", {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            category = response.data.category;

            $('#contact_category_id').kendoDropDownList({
                optionLabel   : "Select Categroy",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: category,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

        });
    
    $scope.getContactType = function () {
        $scope.contact_category_id = $("#contact_category_id").data("kendoDropDownList").value();

        $http
            .get(window.location.origin + "/api/contact/get-contact-category", {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                agent = response.data.agent;

                $('#agent_id').kendoDropDownList({
                    optionLabel   : "Select Agent",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: agent,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

            });
    }
}
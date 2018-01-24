var contact = angular.module('app', []);
contact.controller('ContactEditController', ContactEditController);

function ContactEditController($scope, $http) {

    var contact_id = document.getElementsByName('contact_id')[0].value;

    $http
        .get(window.location.origin + "/api/contact/get-contact/" + contact_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            $scope.contact = response.data.contact;
            category = response.data.category;
            agent = response.data.agent;

            $('#contact_category_id').kendoDropDownList({
                optionLabel   : "Select Categroy",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: category,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#contact_category_id").data("kendoDropDownList");


            dropdownlist.value($scope.contact.contact_category_id);


            $scope.category_id = $scope.contact.contact_category_id;

            if($scope.category_id == 1 || $scope.category_id == 2)
            {
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

                        var dropdownlist = $("#agent_id").data("kendoDropDownList");


                        dropdownlist.value($scope.contact.agent_id);

                    });
            }

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
                    optionLabel   : "Select Categroy",
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
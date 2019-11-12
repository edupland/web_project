/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var appRun = function ( $state, $uibModal,editableOptions) {
    editableOptions.theme = 'bs3';
    $state.go("app.home"); 
};
appRun.$inject = ["$state", "$uibModal","editableOptions"];
module.exports = appRun;



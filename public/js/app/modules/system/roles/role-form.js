
let RoleForm = (function() {

    let roleMap =[];

    function init() {
        initEvents();
    }

    function initEvents() {
        $(document).on('click', '[action=edit-role]', function() {
            swal('Upcoming Feature', 'This will be implemented by deployment :)', 'warning');
        });
    }

    function setRoles(roles) {        
        roles.forEach(role => {
            roleMap[role.id] = role;
        });
    }

    function showRoleWithId(roleId) {
        console.log(roleMap[roleId]);
        let html = tmpl("tmpl-role-view", roleMap[roleId]);
        $('.role-form-container').html(html);
    }    

    return { init, setRoles, showRoleWithId };

})();
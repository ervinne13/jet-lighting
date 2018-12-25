
let IndexPage = (function() {

    let RoleForm;

    function init(RoleFormRef) {
        RoleForm = RoleFormRef;
        initEvents();
    }

    function initEvents() {
        $('[action=view-role]').click(function() {
            let roleId = $(this).data('id');
            RoleForm.showRoleWithId(roleId);
        });
    }

    return { init };

})();
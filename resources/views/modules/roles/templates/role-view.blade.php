<script id="tmpl-role-view" type="text/template">
    <div class="m-t-l"></div>
    <h4 class="m-t-l">{%= o.name %}</h4>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Code</th>                                    
                <th>Module</th>
                <th>Access</th>
            </tr>
        </thead>
        <tbody>
            {% for (let i in o.accessControlList) { %}
            <tr>
                <td>{%= o.accessControlList[i].module.code %}</td>                                    
                <td>{%= o.accessControlList[i].module.name %}</td>
                <td> <span class="badge badge-primary">{%= o.accessControlList[i].access %}</span> </td>
            </tr>
            {% } %}
        </tbody>
    </table>

    <div class="pull-right">
        <button 
            action="edit-role" data-id="{%= o.id %}" 
            type="button" class="btn btn-w-m btn-primary">
            Edit
        </button>
    </div>
</script>
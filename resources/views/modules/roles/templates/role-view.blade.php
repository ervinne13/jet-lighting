<script id="tmpl-role-view" type="text/template">
    <div class="m-t-lg"></div>
    <h4 class="m-t-lg">{%= o.name %}</h4>

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
            {% 
                let colorClass = 'badge-primary';
                switch(o.accessControlList[i].access) {
                    case 'viewer':
                        colorClass = 'badge-success';
                        break;
                    case 'author':
                        colorClass = 'badge-info';
                        break;
                }
            %}

            <tr>
                <td>{%= o.accessControlList[i].module.code %}</td>                                    
                <td>{%= o.accessControlList[i].module.name %}</td>
                <td> <span class="badge {%= colorClass %}">{%= o.accessControlList[i].access %}</span> </td>
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
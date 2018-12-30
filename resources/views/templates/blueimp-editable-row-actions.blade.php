
{% if (o.editable) { %}
<a href="javascript:;" data-id="{%= o.id %}" action="edit-row" data-container="body" data-toggle="tooltip" data-placement="top" title="Edit">
    <span class="fa fa-pencil"></span>
</a>
{% } %}

{% if (o.deletable) { %}
<a href="javascript:;" data-id="{%= o.id %}" action="delete-row" data-container="body" data-toggle="tooltip" data-placement="top" title="Delete">
    <span class="fa fa-times"></span>
</a>
{% } %}
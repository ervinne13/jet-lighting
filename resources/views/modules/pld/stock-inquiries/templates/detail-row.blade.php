<script id="tmpl-detail-row" type="text/template">
    <tr class="selectable" data-id={%= o.item.code %}>
        <td>{%= o.item.code %}</td>
        <td>{%= o.item.name %}</td>
        <td>{%= o.neededQuantity %}</td>
        <td>
            {% if (o.supplier) { %}
            {%= o.supplier.name %}
            {% } %}
        </td>
        <td>
            <div class="badge {%= o.badgeClass %}">{%= o.status %}</div>
        </td>
        <td>
            @include('templates.blueimp-editable-row-actions')
        </td>
    </tr>
</script>
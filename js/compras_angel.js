var ticketTable = $('.tab-content #ticket');
var producto;
var tableTemplate;
var headerTableTemplate = `
  <table class="table table-hover"> 
    <thead>
      <tr>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Precio Mayoreo</th>
        <th class="text-center">Precio Unitario Mayoreo</th>
        <th class="text-center">Precio Menudeo</th>
      </tr>
      <tr>
        <th class="text-center">
          <input type="text" class="form-control buscar_descripcion" data-indice="0" placeholder="Buscar descripcion">
        </th>
      </tr>
    </thead>
  </table>
    `;
$(document).ready(function onLoad() {
  $(".btn_producto").click(addProduct);
  ticketTable.append(headerTableTemplate);
});

function addProduct() {
  producto = $(this).data();
  var table = $('.tab-content #ticket table');
  tableTemplate =
    `<tbody>   
      <tr>
        <td class="text-center">${producto.descripcion_productos}</th>
        <td class="text-center">$ </th>
        <td class="text-center">$ </th>
        <td class="text-center">$ ${producto.precio_menudeo} ()</th>
      </tr>
    </tbody>`;
  table.append(tableTemplate);
  console.log(producto.descripcion_productos);
}
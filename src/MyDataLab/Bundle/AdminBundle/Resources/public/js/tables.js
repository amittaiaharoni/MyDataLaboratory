/*! mil4o tables.js
 * ================
 * Custom JS application file for DataTables
 * should be included in all pages with tables. 
 * 
 * @Author  Milcho Koroveshovslki
 * @Email   <jassum@gmail.com>
 * @version 1
 * @license MIT <http://opensource.org/licenses/MIT>
 */

 //FILTER FUNCTION SEARCH STRING

function filterme() {
  //build a regex filter string with an or(|) condition
  var types = $('input:checkbox[name="type"]:checked').map(function() {
    return '^' + this.value + '\$';
  }).get().join('|');
  //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
  otable.fnFilter(types, 0, true, false, false, false);

  //build a filter string with an or(|) condition
  var frees = $('input:checkbox[name="free"]:checked').map(function() {
    return this.value;
  }).get().join('|');
  //now filter in column 2, with no regex, no smart filtering, no inputbox,not case sensitive
  otable.fnFilter(frees, 1, false, false, false, false);
}


$('#products1').DataTable( {
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
    } );

	$('#sproduct1').DataTable( {
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
    } );

	$('#test').on('click', function(){
		//uncheck all checkboxes
		$("[type='checkbox']").prop("checked", false);
		//clear all filters
		var table = $('#products1').dataTable();
    table.fnFilterClear();
	});		$("[type='checkbox']").prop("checked", false);

	$('#test2').on('click', function(){
		//uncheck all checkboxes
		//clear all filters
		var table = $('#sproduct1').dataTable();
    table.fnFilterClear();
	});
	$('#test3').on('click', function(){
		//uncheck all checkboxes
		$("[type='checkbox']").prop("checked", false);
		//clear all filters
		var table = $('#wording').dataTable();
    table.fnFilterClear();
	});




 

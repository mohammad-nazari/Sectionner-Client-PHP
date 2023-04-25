/**
 * Created by Mohammad on 26/01/2016.
 */
var gridster;

$(function () {

	gridster = $(".gridster > ul").gridster({
		widget_margins: [5, 5],
		widget_base_dimensions: [200, 200],
		min_cols: 6,
		resize: {
			enabled: false
		}
	}).data('gridster');
});
function AddDeviceGrid(TagData, Section) {
	gridster.add_widget(TagData, 1, 1);
}
function RemoveDeviceGrid(TagID) {
	gridster.remove_widget($('#' + TagID));
}
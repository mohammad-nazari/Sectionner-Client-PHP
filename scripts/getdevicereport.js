/**
 * Created by Mohammad on 31/01/2016.
 */

/**
 *
 * @param Report
 */
function FillReportCharts(Report) {
	if (Report._recordsCount > 0) {
		if (Report._deviceModel == "SECTIONNER") {
			$("#sectionner-report").show();
			$("#manager-report").hide();
			ResetFillChartsData("acvs0", Report._chartList["ACVOLTAGE"][0]._dataLabels, Report._chartList["ACVOLTAGE"][0]._data, Report._chartList["ACVOLTAGE"][0]._labels, 6, Report._chartList["ACVOLTAGE"][0]._dataSetColor);
			FillTableData(Report._chartList["ACVOLTAGE"][0]._dataLabels, Report._chartList["ACVOLTAGE"][0]._data, Report._chartList["ACVOLTAGE"][0]._labels, 6, 'acvsTable-0');

			ResetFillChartsData("acas0", Report._chartList["ACAMPERE"][0]._dataLabels, Report._chartList["ACAMPERE"][0]._data, Report._chartList["ACAMPERE"][0]._labels, 3, Report._chartList["ACAMPERE"][0]._dataSetColor);
			FillTableData(Report._chartList["ACAMPERE"][0]._dataLabels, Report._chartList["ACAMPERE"][0]._data, Report._chartList["ACAMPERE"][0]._labels, 3, 'acasTable-0');

			ResetFillChartsData("cosqs0", Report._chartList["COSQ"][0]._dataLabels, Report._chartList["COSQ"][0]._data, Report._chartList["COSQ"][0]._labels, 3, Report._chartList["COSQ"][0]._dataSetColor);
			FillTableData(Report._chartList["COSQ"][0]._dataLabels, Report._chartList["COSQ"][0]._data, Report._chartList["COSQ"][0]._labels, 3, 'cosqsTable-0');

			ResetFillChartsData("powers0", Report._chartList["DIGITALEXIST"][0]._dataLabels, Report._chartList["DIGITALEXIST"][0]._data, Report._chartList["DIGITALEXIST"][0]._labels, 4, Report._chartList["DIGITALEXIST"][0]._dataSetColor);
			FillTableData(Report._chartList["DIGITALEXIST"][0]._dataLabels, Report._chartList["DIGITALEXIST"][0]._data, Report._chartList["DIGITALEXIST"][0]._labels, 4, 'powersTable-0');

			ResetFillChartsData("reactives0", Report._chartList["DIGITALOUTPUT"][0]._dataLabels, Report._chartList["DIGITALOUTPUT"][0]._data, Report._chartList["DIGITALOUTPUT"][0]._labels, 4, Report._chartList["DIGITALOUTPUT"][0]._dataSetColor);
			FillTableData(Report._chartList["DIGITALOUTPUT"][0]._dataLabels, Report._chartList["DIGITALOUTPUT"][0]._data, Report._chartList["DIGITALOUTPUT"][0]._labels, 4, 'reactivesTable-0');

			ShowAlert("پیام", "گزارش با موفقیت دریافت شد");
		}
		else {
			$("#sectionner-report").hide();
			$("#manager-report").show();
			for (var i = 0; i < 4; i++) {
				ResetFillChartsData("acvm" + (i), Report._chartList["ACVOLTAGE"][i]._dataLabels, Report._chartList["ACVOLTAGE"][i]._data, Report._chartList["ACVOLTAGE"][i]._labels, 6, Report._chartList["ACVOLTAGE"][0]._dataSetColor);
				FillTableData(Report._chartList["ACVOLTAGE"][i]._dataLabels, Report._chartList["ACVOLTAGE"][i]._data, Report._chartList["ACVOLTAGE"][i]._labels, 6, 'acvmTable-' + i);

				ResetFillChartsData("acam" + (i), Report._chartList["ACAMPERE"][i]._dataLabels, Report._chartList["ACAMPERE"][i]._data, Report._chartList["ACAMPERE"][i]._labels, 8, Report._chartList["ACAMPERE"][0]._dataSetColor);
				FillTableData(Report._chartList["ACAMPERE"][i]._dataLabels, Report._chartList["ACAMPERE"][i]._data, Report._chartList["ACAMPERE"][i]._labels, 8, 'acamTable-' + i);
			}
			ResetFillChartsData("cosqm0", Report._chartList["COSQ"][0]._dataLabels, Report._chartList["COSQ"][0]._data, Report._chartList["COSQ"][0]._labels, 3, Report._chartList["COSQ"][0]._dataSetColor);
			FillTableData(Report._chartList["COSQ"][0]._dataLabels, Report._chartList["COSQ"][0]._data, Report._chartList["COSQ"][0]._labels, 3, 'cosqmTable-0');

			ResetFillChartsData("temm0", Report._chartList["TEMPERATURE"][0]._dataLabels, Report._chartList["TEMPERATURE"][0]._data, Report._chartList["TEMPERATURE"][0]._labels, 4, Report._chartList["TEMPERATURE"][0]._dataSetColor);
			FillTableData(Report._chartList["TEMPERATURE"][0]._dataLabels, Report._chartList["TEMPERATURE"][0]._data, Report._chartList["TEMPERATURE"][0]._labels, 4, 'temmTable-0');

			ResetFillChartsData("humm0", Report._chartList["HUMIDITY"][0]._dataLabels, Report._chartList["HUMIDITY"][0]._data, Report._chartList["HUMIDITY"][0]._labels, 4, Report._chartList["HUMIDITY"][0]._dataSetColor);
			FillTableData(Report._chartList["HUMIDITY"][0]._dataLabels, Report._chartList["HUMIDITY"][0]._data, Report._chartList["HUMIDITY"][0]._labels, 4, 'hummTable-0');

			ShowAlert("پیام", "گزارش با موفقیت دریافت شد");
		}
	}
	else {
		ShowAlert("پیام","هیچ رکوردی یافت نشد");
	}
}

function ResetFillChartsData(ChartName, ChartDataLabels, ChartData, DataLabel, Rows, DataSetColor) {
	var dataSetList = [];
	var tableData   = [];
	for (var i = 0; i < Rows; i++) {
		dataSetList.push({
			label               : DataLabel[i],
			data                : ChartData[i],
			borderWidth         : 0,
			borderColor         : DataSetColor[i],
			backgroundColor     : DataSetColor[i],
			pointBorderColor    : DataSetColor[i],
			pointBackgroundColor: DataSetColor[i],
			pointBorderWidth    : 0,
			fill                : false
		});
	}
	sensorChartConfig[ChartName].data = {
		labels  : ChartDataLabels,
		datasets: dataSetList
	};
	window.sensorChart[ChartName].update();

}

function FillTableData(ChartDataLabels, ChartData, DataLabel, Rows, TableName) {
	var count     = ChartDataLabels.length;
	var tableData = [];
	for (var i = 0; i < count; i++) {
		var tableRowData = [ChartDataLabels[i]];
		for (var j = 0; j < Rows; j++) {
			tableRowData.push(ChartData[j][i])
		}
		tableData.push(tableRowData);
	}
	var tableColumnNames = [{title: "Date"}];
	for (j = 0; j < Rows; j++) {
		tableColumnNames.push({title: DataLabel[j]});
	}

	$("#table-" + TableName).html('<table id="' + TableName + '" class="display" width="100%"></table>');
	$('#' + TableName).DataTable({
		columns: tableColumnNames,
		data   : tableData
	});
}
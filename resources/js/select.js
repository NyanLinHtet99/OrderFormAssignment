import $ from "jquery";
window.$ = window.jQuery = $;
import '@selectize/selectize';
let select = function () {

    let productSelector = function () {
        //set an empty selectize object so that the css is properly setup while getting data from ajax
        function defaultRender() {
            $('#product').selectize({
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                selectOnTab: true,
                closeAfterSelect: true,
                onChange: showPrice,
            });
        }
        //called by the product onChange event. Grab the price of the selected option
        //set price to empty if the selected option is changed back to empty
        function showPrice(id) {
            if (!id) {
                $('#price').text('');
                return;
            }
            $('#product').removeClass('is-invalid');
            $('#price').text('Price = ' + this.options[this.items[0]].price + 'MMK');
        }

        function getData() {
            $.ajax({
                url: "api/products",
                type: "get",
                dataType: "json",
                success: function (response) {
                    let select = $('#product')[0].selectize;
                    response.map(function (product) {
                        select.addOption({
                            'id': product.id, 'name': product.name, 'price': product.price,
                        });
                    });
                    //data-oldValue come from SSR where it will attach it if old('product') exists
                    if ($('#product').is('[data-oldValue]')) {
                        select.setValue($('#product').attr('data-oldValue'));
                    }
                },
            });
        }
        function init() {
            defaultRender();
            getData();
        }
        return { init }
    }();
    let nrcRegionSelector = function () {
        //set an empty selectize object so that the css is properly setup while getting data from ajax
        //onChange function is set to the reqTownship where it will get the data belonging to the selected option
        //needs to change it into pub-sub
        function defaultRender() {
            $('#nrc_region').selectize({
                valueField: 'id',
                labelField: 'nrcRegion',
                searchField: 'nrcRegion',
                selectOnTab: true,
                closeAfterSelect: true,
                onChange: nrcTownshipSelector.reqTownship,
            });
        }
        function getData() {
            $.ajax({
                url: "api/nrcregions/",
                type: "get",
                dataType: "json",
                success: function (response) {
                    let select = $('#nrc_region')[0].selectize;
                    response.map(function (id) {
                        select.addOption({
                            'id': id, 'nrcRegion': id + '/'
                        })
                    })
                    //data-oldValue come from SSR where it will attach it if old('nrc_region') exists
                    if ($('#nrc_region').is('[data-oldValue]')) {
                        select.setValue($('#nrc_region').attr('data-oldValue'));
                    }
                },
            });
        }
        function init() {
            defaultRender();
            getData();
        }
        return { init }
    }();
    let nrcTownshipSelector = function () {
        const select = $('#nrc_township')[0];
        //set an empty selectize object so that the css is properly setup while getting data from ajax
        function defaultRender() {
            $('#nrc_township').selectize({
                valueField: 'name',
                labelField: 'name',
                searchField: 'name',
                selectOnTab: true,
                closeAfterSelect: true,
            });
        }
        /* called by the onChange of nrcRegionSelector grab the value
        of selected option and if empty clear all the options if exists */
        function reqTownship(id) {
            if (!id) {
                //if the value of township is empty change the placeholder so
                //the user knows it need to select region first
                changePlaceholder('select region first')
                select.selectize.clearOptions();
            }
            else {
                //the defualt place holder state that the user needs to select region first
                changePlaceholder('OoKaMa');
                select.selectize.clearOptions();
                getData(id);
            }
        }
        function changePlaceholder(text) {
            select.selectize.settings.placeholder = text;
            select.selectize.updatePlaceholder();
        }
        function getData(id) {
            $.ajax({
                url: "api/nrctownships",
                data: { "id": id },
                type: "get",
                dataType: "json",
                success: function (response) {
                    response.map(function (name) {
                        select.selectize.addOption({
                            'name': name
                        })
                    })
                    //data-oldValue come from SSR where it will attach it if old('nrc_township') exists
                    if ($('#nrc_township').is('[data-oldValue]')) {
                        select.selectize.setValue($('#nrc_township').attr('data-oldValue'));
                    }
                },
            });
        }
        function init() {
            defaultRender();
        }
        return { init, reqTownship }
    }();
    function init() {
        productSelector.init();
        nrcRegionSelector.init();
        nrcTownshipSelector.init();
    }
    return { init };
}();
export default select;

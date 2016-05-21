LB.namespace('app');

LB.app = function ($, document) {
    var _system = LB.system,

    short_news_block = function () {
        $('#pinBoot').pinterest_grid({
            no_columns: 4,
            padding_x: 10,
            padding_y: 10,
            margin_bottom: 50,
            single_column_breakpoint: 700
        });
    };
    
    _system.registerAutoload(short_news_block);
}(jQuery, document);
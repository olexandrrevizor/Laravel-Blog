/**
 * Main javascript module
 *
 * @module LB
 * @package main
 */

"use strict";

var LB = LB || {};

LB.namespace = function(ns_string){
    var parts = ns_string.split('.'),
        parent = LB,
        i;
    // strip redundant leading global
    if(parts[0] === "LB"){
        parts = parts.slice(1);
    }
    for(i = 0; i < parts.length; i += 1){
        // create a property if it doesn't exist
        if(typeof parent[parts[i]] === "undefined"){
            parent[parts[i]] = {};
        }
        parent = parent[parts[i]];
    }
    return parent;
};

/**
 * System method, variable and config
 */
LB.namespace('system');
LB.system = (function(document, $){

    //private var
    var name = 'LB overflow',
        version = '1.0.0',
        autoload = [],

    //private method
        autoLoad = function(){
            var count = autoload.length,
                counter;

            if(count > 0){
                for(counter = 0; counter < count; counter +=1){
                    if(typeof autoload[counter].function === 'function'){
                        if(autoload[counter].params === null) {
                            autoload[counter].function.apply(window);
                        }else{
                            autoload[counter].function.apply(window, autoload[counter].params);
                        }
                    }
                }
            }

            return this;
        },
        addOnLoad = function(func, params){
            var params_array = params || null;
            if(typeof func === 'function'){
                autoload.push({'function':func, 'params': params_array});
            }
            return this;
        },
        onLoad = function(){
            $(document).ready(function(){
                autoLoad();
                return this;
            });
        };

    //public method
    return {
        onLoad: onLoad,
        registerAutoload: addOnLoad
    }

})(document, $);
LB.system.onLoad();
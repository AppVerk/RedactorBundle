var Redactor = function () {
    return {
        init: function() {
            $(document).ready(function() {
                $(".redactor").attr("required", false);

                var getFunctionByName = function(functionName, context /*, args */) {
                    var namespaces = functionName.split(".");
                    var func = namespaces.pop();
                    for(var i = 0; i < namespaces.length; i++) {
                        context = context[namespaces[i]];
                    }
                    return context[func];
                };

                var prepareConfig = function(config)
                {
                    var callbackList = ['fileUploadErrorCallback', 'imageUploadErrorCallback', 'fileUploadCallback', 'imageUploadCallback'];
                    for (var i = 0; i < callbackList.length; i++) {
                        var callbackName = callbackList[i];
                        if (config[callbackName]) {
                            config[callbackName] = getFunctionByName(config[callbackName], window);
                        }
                    }
                };

                if(typeof configRedactor !== 'undefined'){
                    for (var redactorId in configRedactor) {
                        var config = configRedactor[redactorId];
                        prepareConfig(config);

                        $("#" + redactorId).redactor(config);
                    }
                }
            });

        }
    };
}();

Redactor.init();


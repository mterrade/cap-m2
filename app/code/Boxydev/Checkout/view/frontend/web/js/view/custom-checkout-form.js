define([
    'Magento_Ui/js/form/form'
], function (Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();

            return this;
        },

        /**
         * A la soumission du formulaire
         */
        onSubmit: function () {
            // Trigger la validation du formulaire
            this.source.set('params.invalid', false);
            this.source.trigger('customCheckoutForm.data.validate');

            // Vérifier si les données du formulaire sont valides
            if (!this.source.get('params.invalid')) {
                // On peut utiliser le nom du customScope pour récupérer les données du formulaire
                var formData = this.source.get('customCheckoutForm');
                // Affiche les données
                console.log(formData);
            }
        }
    });
});

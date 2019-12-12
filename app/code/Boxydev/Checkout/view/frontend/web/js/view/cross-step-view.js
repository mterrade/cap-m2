define([
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator'
], function (ko, Component, _, stepNavigator) {
    'use strict';

    return Component.extend({
        defaults: {
            // Correspond au nom du template à afficher
            template: 'Boxydev_Checkout/cross-step'
        },

        // Callback pour rendre visible ou non l'étape
        isVisible: ko.observable(true),

        initialize: function () {
            this._super();

            // On ajoute l'étape
            stepNavigator.registerStep(
                // Identifiant de l'étape qui apparait dans l'url
                'cross-step',
                null,
                // Le titre de l'étape
                'Cross step',
                // Le callback pour savoir si on affiche l'étape
                this.isVisible,
                _.bind(this.navigate, this),
                // Priorité de l'étape
                // Moins de 10 : Avant l'étape de livraison
                // Entre 10 et 20 : Entre la livraison et le paiement
                // Plus que 20 : Après l'étape de paiement
                9
            );

            return this;
        },

        /**
         * Cette méthode est appelée si on arrive sur l'url de l'étape directement
         */
        navigate: function () {
            this.isVisible(true);
        },

        /**
         * Pour se rendre à l'étape suivante
         */
        navigateToNextStep () {
            stepNavigator.next();
        },

        /**
         * On récupère les produits à afficher en cross dans le panier
         */
        getCrossProducts: function () {
            return window.checkoutConfig.crossProducts;
        }
    });
});

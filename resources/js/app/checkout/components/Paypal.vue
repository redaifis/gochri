<template>
    <div id="paypal-button-container" ref="paypal"></div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    mounted() {
        this.setLoaded()
    },
    methods: {
        setLoaded() {
            window.paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                currency_code: 'EUR',
                                value: '20.30'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page
        }
    }
}
</script>

<style>

</style>

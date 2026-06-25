new Vue({
    el: '#app',
    data: {
        fees: [
            { label: '', price: '' }
        ]
    },
     mounted() {
        console.log(variations, JSON.parse(variations));
        if (typeof variations !== 'undefined' && variations) {
            try {
                this.fees = JSON.parse(variations);
            } catch (e) {
                this.fees = [{ label: '', price: '' }];
            }
        } else {
            this.fees = [{ label: '', price: '' }];
        }
    },
    methods: {
        addRow() {
            this.fees.push({ label: '', price: '' });
        },
        removeRow(index) {
            this.fees.splice(index, 1);
        }
    }
});
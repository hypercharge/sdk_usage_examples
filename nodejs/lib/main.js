
var Schema = require('hypercharge-schema').Schema;
errors = Schema.validate('sale', {transaction_type: 'sale', transaction_id:'23423423423'});
console.log(errors);
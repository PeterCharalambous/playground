module.exports = {
  'New Account Test': function (client) {
    client
      .url('http://dev.local/')
      .setValue('input[name="firstName"]', 'First Name Test')
      .setValue('input[name="lastName"]', 'Last Name Test')
      .setValue('input[name="street"]', 'Street Test')
      .setValue('input[name="suburb"]', 'Suburb Test')
      .click('#state option[value="VIC"]')
      .setValue('input[name="postcode"]', '3000')
      .setValue('input[name="mobile"]', '0410000000')
      .pause(2000)
      .click('#submit')
      .assert.elementPresent('#alert')
      .end();
  }
};
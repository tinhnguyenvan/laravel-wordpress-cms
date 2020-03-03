Login
=======

The following are examples of supported markup.  On their own, these will not provide a datepicker widget; you will need to instantiate the datepicker on the markup.


code
-----

``
    // không tốt
    const atom = {
      value: 1,

      addValue: function (value) {
        return atom.value + value;
      },
    };

    // tốt
    const atom = {
      value: 1,

      addValue(value) {
        return atom.value + value;
      },
    };
``

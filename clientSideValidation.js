const validation = new JustValidate("#signup");
const passwordValidator = (value) => {
  const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,16}$/;
  return regex.test(value);
};

validation
  .addField("#name", [
    { rule: "required" },
    { rule: "minLength", value: 3 },
    { rule: "maxLength", value: 15 }
  ])
  .addField("#surname", [
    { rule: "required" },
    { rule: "minLength", value: 3 },
    { rule: "maxLength", value: 15 }
  ])
  .addField("#username", [
    { rule: "required" },
    { rule: "minLength", value: 3 },
    { rule: "maxLength", value: 15 }
  ])
  .addField("#email", [
    { rule: "required" },
    { rule: "email" },
    {
      validator: (value) => () => {
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
          .then(response => response.json())
          .then(json => json.available);
      },
      errorMessage: "Email already taken"
    }
  ])
  .addField("#password", [
    { rule: "required" },
    { rule: "minLength", value: 8 },
    { rule: "maxLength", value: 16 },
    {
      validator: (value) => passwordValidator(value),
      errorMessage: "Password must contain at least 1 uppercase letter, 1 number, and 1 special character, length 8-16"
    }
  ])
  .addField("#password_confirmation", [
    {
      validator: (value, fields) => {
        return value === fields["#password"].elem.value;
      },
      errorMessage: "Passwords should match"
    }
  ])
  .onSuccess((event) => {
    document.getElementById("signup").submit();
  });

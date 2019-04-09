module.exports = {
  root: true,
  env: {
    node: true
  },
  'extends': [
    'plugin:vue/essential',
    '@vue/standard'
  ],
  "rules": {
    // Vue specific Rules
    "vue/attributes-order": ["error", {
      order: [
        "DEFINITION",
        "LIST_RENDERING",
        "CONDITIONALS",
        "RENDER_MODIFIERS",
        "GLOBAL",
        "UNIQUE",
        "OTHER_ATTR",
        "CONTENT",
        "BINDING",
        "EVENTS"
      ]
    }],
    "vue/no-multi-spaces": "off",
    "vue/max-attributes-per-line": ["error", {
      "singleline": 2,
      "multiline": {
        "max": 1,
        "allowFirstLine": false
      }
    }],

    "vue/html-indent": ["error", 2],
    "camelcase": ["error", { // enforces camelcase except for consts declared in all caps
      "properties": "always" // enforces camelcase on object properties (mostly here for compatibility with other stuff when sending stringified objects)
    }],
    "curly": ["error", "multi-or-nest", "consistent"], // makes you surround multi line blocks while also allowing you to not put braces on single line statements
    "key-spacing": ["error", { // this allows you to line up key-value pairs when declaring an object
      "align": "colon"
    }],
    "array-bracket-spacing": ["error", "always", {
      "singleValue": false,
      "objectsInArrays": false,
      "arraysInArrays": false
    }],
    "no-delete-var": "warn", // give a warning when using `delete`
    "no-multi-spaces": ["error", {
      "exceptions": { // these exceptions allow you to line code up
        "Property": true,
        "BinaryExpression": true,
        "VariableDeclarator": true,
        "ImportDeclaration": true
      }
    }],
    "no-useless-constructor": "warn", // give a warning when a constructor could be safely removed from a class
    "semi": ["error", "always", { // enables the use of semicolons
      "omitLastInOneLineBlock": true // allows `if (foo) { bar() }`
    }],
    "template-curly-spacing": "error", // error for `hey ${ name }`, error for `hey ${name }`, error for `hey ${ name}`, allow `hey ${name}`, allow multi line
    "yield-star-spacing": ["error", "after"], // makes `yield*` be used the way it's used on the MDN
    "linebreak-style": "off", // git handles this for us
    "standard/object-curly-even-spacing": "off", // makes it use eslint's curly spacing from above.
    "symbol-description": "off",
    "max-len": "off",
    "newline-before-return": "error",
    "consistent-return": "error",
    "arrow-parens": ["error", "always"],
    "space-before-function-paren": ["error", {
      "anonymous": "always",
      "named": "never",
      "asyncArrow": "always"
    }],
    "no-unused-expressions": "off",
    "object-curly-spacing": "off",
    "no-invalid-this": "off",
    "new-cap": "off",
    "no-continue": "off",
    "babel/new-cap": "off",
    "babel/object-curly-spacing": "off",
    "babel/quotes": "off",
    "babel/semi": "off",
    "babel/no-unused-expressions": "off"
  },
  parserOptions: {
    parser: 'babel-eslint'
  }
}

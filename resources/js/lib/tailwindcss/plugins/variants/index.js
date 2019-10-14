const selectorParser = require('postcss-selector-parser');
const parser = require('postcss-selector-parser');
const get = require('lodash/get');

function escapeClassName (className) {
  const node = parser.className()
  node.value = className
  return get(node, 'raws.value', node.value)
}

module.exports = function ({ addVariant}) {
    addVariant('logged-out', ({ modifySelectors, separator }) => {
        return modifySelectors(({ selector }) => {
            return selectorParser(selectors => {
                selectors.walkClasses(sel => {
                    sel.value = `${escapeClassName(`logged-out\\${ separator }${ sel.value }`)}`;
                    sel.parent.insertBefore(sel, selectorParser().astSync('.logged-out '));
                });
            }).processSync(selector);
        });
    });
    addVariant('logged-in', ({ modifySelectors, separator }) => {
        return modifySelectors(({ selector }) => {
            return selectorParser(selectors => {
                selectors.walkClasses(sel => {
                    sel.value = `${escapeClassName(`logged-in\\${ separator }${ sel.value }`)}`;
                    sel.parent.insertBefore(sel, selectorParser().astSync('.logged-in '));
                });
            }).processSync(selector);
        });
    });
};

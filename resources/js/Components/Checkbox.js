class Checkbox {
    constructor (checked) {
        this.shouldAddErrors = false;
        this.buildContainerElement();
        this.buildLabelElement();
        this.buildLabelText();
        this.buildInputElement(checked);
        this.buildFinalElement();
    }

    addLabel (label) {
        this.labelText.innerHTML = `${label}: `;

        return this;
    }

    setWidth (width) {
        this.input.classList.add(`w-${width}`);

        return this;
    }

    setHeight (height) {
        this.input.classList.add(`h-${height}`);

        return this;
    }

    setErrors (errors) {
        this.shouldAddErrors = true;
        this.input.classList.add('error');
        this.buildErrorElement(errors);

        return this;
    }

    buildHTML () {
        this.label.appendChild(this.labelText);
        this.label.appendChild(this.input);

        if (this.shouldAddErrors) {
            this.label.appendChild(this.errorElement);
        }

        this.containerElement.appendChild(this.label);

        return this;
    }

    buildErrorElement (errors) {
        this.errorElement = document.createElement('div');
        this.errorElement.classList.add('form-error');
        this.errorElement.innerHTML = errors[0];
    }

    buildContainerElement () {
        this.containerElement = document.createElement('div');
        this.containerElement.classList.add('v-checkbox', 'block', 'mt-2');
    }

    buildLabelElement () {
        this.label = document.createElement('label');
        this.label.classList.add('inline-flex', 'items-center');
    }

    buildLabelText () {
        this.labelText = document.createElement('span');
        this.labelText.classList.add('mr-2', 'text-sm', 'font-semibold');
    }

    buildInputElement (checked) {
        this.input = document.createElement('input');
        this.input.classList.add('form-checkbox', 'text-blue-600');
        this.input.type = 'checkbox';

        if (checked) {
            this.input.setAttribute('checked', 'checked');
        }

        if (! checked && this.input.getAttribute('checked') === 'checked') {
            this.input.removeAttribute('checked');
        }
    }

    buildFinalElement () {
        let fragment = document.createDocumentFragment();
        fragment.appendChild(this.containerElement);
        this.element = fragment.querySelector('div.v-checkbox');
    }

    toString () {
        return this.element.outerHTML;
    }
}

export default Checkbox;

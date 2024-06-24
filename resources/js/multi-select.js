import $ from 'jquery';
import multiSelectOptions from '../constants/multiSelectOptions';

class MultiSelect {
    constructor(element, optionSet) {
        this.$element = $(element);
        this.options = multiSelectOptions[optionSet];
        this.init();
    }

    init() {
        this.$element.html(this.getTemplate());
        this.$selectedItems = this.$element.find('.selected-items');
        this.$dropdownMenu = this.$element.find('.dropdown-menu');
        this.$searchInput = this.$element.find('.option-search');

        this.bindEvents();
    }

    getTemplate() {
        return `
            <div class="selected-items"></div>
            <input type="text" class="form-control option-search" placeholder="Search options...">
            <div class="dropdown-menu">
                ${this.options.map(option => `<div class="dropdown-item" data-value="${option.value}">${option.label}</div>`).join('')}
            </div>
        `;
    }

    bindEvents() {
        this.$element.on('click', () => {
            this.$dropdownMenu.toggle();
            this.$searchInput.focus();
        });

        this.$dropdownMenu.on('click', '.dropdown-item', (e) => {
            const $item = $(e.currentTarget);
            const value = $item.data('value');
            const label = $item.text();

            const $selectedItem = $(`<div class="selected-item badge badge-primary mr-2">${label}<span class="ml-1">&times;</span></div>`);
            $selectedItem.data('value', value);

            this.$selectedItems.append($selectedItem);
            $item.addClass('selected').hide();

            $selectedItem.find('span').on('click', () => {
                $selectedItem.remove();
                this.$dropdownMenu.find(`[data-value="${value}"]`).removeClass('selected').show();
            });
        });

        this.$searchInput.on('keyup', () => {
            const searchText = this.$searchInput.val().toLowerCase();
            this.$dropdownMenu.find('.dropdown-item').each(function() {
                const itemText = $(this).text().toLowerCase();
                if (itemText.includes(searchText) && !$(this).hasClass('selected')) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $(document).on('click', (e) => {
            if (!this.$element.is(e.target) && this.$element.has(e.target).length === 0) {
                this.$dropdownMenu.hide();
            }
        });
    }
}

export default MultiSelect;

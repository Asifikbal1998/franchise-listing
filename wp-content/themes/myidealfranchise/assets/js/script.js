// ===== FRANCHISE DIRECTORY APPLICATION =====
class FranchiseDirectoryApp {
	constructor() {
		this.currentPage = 1;
		this.totalResults = 104;
		this.resultsPerPage = 30;
		this.currentFilters = {};
		this.init();
	}

	// ===== INITIALIZATION =====
	init() {
		this.bindAccordionEvents();
		this.bindFilterEvents();
		this.bindSearchEvents();
		this.bindFranchiseCardEvents();
		this.bindPaginationEvents();
		this.bindSidebarFilterEvents();
	}

	// ===== ACCORDION FUNCTIONALITY =====
	bindAccordionEvents() {
		const accordionTriggers = document.querySelectorAll('.franchise-directory-js-accordion-trigger');

		if (accordionTriggers.length > 0) {
			accordionTriggers.forEach(trigger => {
				trigger.addEventListener('click', (e) => {
					this.handleAccordionToggle(e.target);
				});
			});
		}
	}

	handleAccordionToggle(trigger) {
		if (!trigger) return;

		const targetId = trigger.getAttribute('data-target');
		const targetElement = document.getElementById(targetId);

		if (targetElement) {
			const isExpanded =
				targetElement.classList.contains('franchise-directory__sidebar-menu--expanded') ||
				targetElement.classList.contains('franchise-directory__sidebar-content--expanded');

			if (isExpanded) {
				targetElement.classList.remove('franchise-directory__sidebar-menu--expanded');
				targetElement.classList.remove('franchise-directory__sidebar-content--expanded');
				trigger.classList.add('franchise-directory__sidebar-title--collapsed');
			} else {
				targetElement.classList.add('franchise-directory__sidebar-menu--expanded');
				targetElement.classList.add('franchise-directory__sidebar-content--expanded');
				trigger.classList.remove('franchise-directory__sidebar-title--collapsed');
			}
		}
	}

	// ===== SIDEBAR FILTER FUNCTIONALITY =====
	bindSidebarFilterEvents() {
		// Industry filters
		const industryFilters = document.querySelectorAll('.franchise-directory-js-industry-filter');
		if (industryFilters.length > 0) {
			industryFilters.forEach(filter => {
				filter.addEventListener('click', (e) => {
					e.preventDefault();
					this.handleIndustryFilter(e.target);
				});
			});
		}

		// Category filters
		const categoryFilters = document.querySelectorAll('.franchise-directory-js-category-filter');
		if (categoryFilters.length > 0) {
			categoryFilters.forEach(filter => {
				filter.addEventListener('click', (e) => {
					this.handleCategoryFilter(e.target);
				});
			});
		}
	}

	handleIndustryFilter(filterElement) {
		const allIndustryFilters = document.querySelectorAll('.franchise-directory-js-industry-filter');
		if (allIndustryFilters.length > 0) {
			allIndustryFilters.forEach(filter => {
				filter.classList.remove('franchise-directory__sidebar-menu-link--active');
			});
		}

		if (filterElement) {
			filterElement.classList.add('franchise-directory__sidebar-menu-link--active');

			const category = filterElement.getAttribute('data-category');
			this.applyFilter('industry', category);
		}
	}

	handleCategoryFilter(filterElement) {
		const allCategoryFilters = document.querySelectorAll('.franchise-directory-js-category-filter');
		if (allCategoryFilters.length > 0) {
			allCategoryFilters.forEach(filter => {
				filter.classList.remove('franchise-directory__sidebar-content-item--active');
			});
		}

		if (filterElement) {
			filterElement.classList.add('franchise-directory__sidebar-content-item--active');
			const category = filterElement.getAttribute('data-category');
			this.applyFilter('category', category);
		}
	}

	// ===== FILTER FUNCTIONALITY =====
	bindFilterEvents() {
		const filterButton = document.querySelector('.franchise-directory-js-filter-apply');

		if (filterButton) {
			filterButton.addEventListener('click', () => {
				this.handleFilterApply();
			});
		}
	}

	handleFilterApply() {
		const sortSelect = document.querySelector('.franchise-directory-js-sort-select');
		const filterSelect = document.querySelector('.franchise-directory-js-filter-select');
		const locationSelect = document.querySelector('.franchise-directory-js-location-select');
		const investmentSelect = document.querySelector('.franchise-directory-js-investment-select');

		this.currentFilters = {
			sort: sortSelect ? sortSelect.value : "",
			filter: filterSelect ? filterSelect.value : "",
			location: locationSelect ? locationSelect.value : "",
			investment: investmentSelect ? investmentSelect.value : ""
		};

		this.applyFilters(this.currentFilters);
	}

	// ===== SEARCH FUNCTIONALITY =====
	bindSearchEvents() {
		const searchButton = document.querySelector('.franchise-directory-js-search-submit');
		const searchInput = document.querySelector('.franchise-directory-js-search-input');

		if (searchButton) {
			searchButton.addEventListener('click', () => {
				this.handleSearch();
			});
		}

		if (searchInput) {
			searchInput.addEventListener('keypress', (e) => {
				if (e.key === 'Enter') {
					this.handleSearch();
				}
			});
		}
	}

	handleSearch() {
		const searchInput = document.querySelector('.franchise-directory-js-search-input');
		if (!searchInput) return;

		const searchTerm = searchInput.value.trim();
		if (searchTerm) {
			this.performSearch(searchTerm);
		}
	}

	// ===== FRANCHISE CARD FUNCTIONALITY =====
	bindFranchiseCardEvents() {
		const addToListButtons = document.querySelectorAll('.franchise-directory-js-add-to-list');

		if (addToListButtons.length > 0) {
			addToListButtons.forEach(button => {
				button.addEventListener('click', (e) => {
					this.handleAddToList(e.target);
				});
			});
		}
	}

	handleAddToList(button) {
		if (!button) return;

		const card = button.closest('.franchise-directory__franchise-card');
		if (!card) return;

		const franchiseTitle = card.querySelector('.franchise-directory__franchise-title');
		const franchiseName = franchiseTitle ? franchiseTitle.textContent : "";

		if (button.textContent.includes('Add to Request List')) {
			button.textContent = '✓ Added to Request List';
			button.classList.add('franchise-directory__franchise-button--added');
			console.log('Added to request list:', franchiseName);
		} else {
			button.textContent = 'Add to Request List';
			button.classList.remove('franchise-directory__franchise-button--added');
			console.log('Removed from request list:', franchiseName);
		}
	}

	// ===== PAGINATION FUNCTIONALITY =====
	bindPaginationEvents() {
		const prevButton = document.querySelector('.franchise-directory-js-pagination-prev');
		const nextButton = document.querySelector('.franchise-directory-js-pagination-next');
		const pageButtons = document.querySelectorAll('.franchise-directory-js-pagination-page');

		if (prevButton) {
			prevButton.addEventListener('click', () => {
				this.handlePaginationPrev();
			});
		}

		if (nextButton) {
			nextButton.addEventListener('click', () => {
				this.handlePaginationNext();
			});
		}

		if (pageButtons.length > 0) {
			pageButtons.forEach(button => {
				button.addEventListener('click', (e) => {
					const page = parseInt(e.target.getAttribute('data-page'));
					this.handlePaginationPage(page);
				});
			});
		}
	}

	handlePaginationPrev() {
		if (this.currentPage > 1) {
			this.loadPage(this.currentPage - 1);
		}
	}

	handlePaginationNext() {
		const maxPage = Math.ceil(this.totalResults / this.resultsPerPage);
		if (this.currentPage < maxPage) {
			this.loadPage(this.currentPage + 1);
		}
	}

	handlePaginationPage(page) {
		this.loadPage(page);
	}

	// ===== UTILITY METHODS =====
	applyFilter(type, category) {
		this.showLoadingState();

		setTimeout(() => {
			this.hideLoadingState();
			this.updatePageTitle(`SEARCH RESULTS FOR: ${category.toUpperCase().replace('-', ' ')}`);
			console.log(`Filtered by ${type}:`, category);
		}, 500);
	}

	applyFilters(filters) {
		this.showLoadingState();

		setTimeout(() => {
			this.hideLoadingState();
			console.log('Filters applied:', filters);
		}, 500);
	}

	performSearch(searchTerm) {
		this.showLoadingState();

		setTimeout(() => {
			this.hideLoadingState();
			this.updatePageTitle(`SEARCH RESULTS FOR: "${searchTerm.toUpperCase()}"`);
			console.log('Search performed for:', searchTerm);
		}, 500);
	}

	loadPage(pageNum) {
		this.currentPage = pageNum;

		const pageButtons = document.querySelectorAll('.franchise-directory-js-pagination-page');

		if (pageButtons.length > 0) {
			pageButtons.forEach(button => {
				button.classList.remove('franchise-directory__pagination-button--active');
				if (parseInt(button.getAttribute('data-page')) === pageNum) {
					button.classList.add('franchise-directory__pagination-button--active');
				}
			});
		}

		const startResult = (pageNum - 1) * this.resultsPerPage + 1;
		const endResult = Math.min(pageNum * this.resultsPerPage, this.totalResults);
		const paginationInfo = document.querySelector('.franchise-directory-js-pagination-info');

		if (paginationInfo) {
			paginationInfo.textContent = `${startResult} - ${endResult} OF ${this.totalResults} RESULTS`;
		}

		this.showLoadingState();

		setTimeout(() => {
			this.hideLoadingState();
			console.log(`Loaded page ${pageNum}`);
		}, 300);
	}

	showLoadingState() {
		const grid = document.querySelector('.franchise-directory-js-franchise-grid');
		if (grid) grid.classList.add('franchise-directory__loading');
	}

	hideLoadingState() {
		const grid = document.querySelector('.franchise-directory-js-franchise-grid');
		if (grid) grid.classList.remove('franchise-directory__loading');
	}

	updatePageTitle(title) {
		const pageTitle = document.querySelector('.franchise-directory-js-page-title');
		if (pageTitle) pageTitle.textContent = title;
	}
}

// ===== APPLICATION INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function () {
	new FranchiseDirectoryApp();
});

// ===== JQUERY HOVER EFFECT =====
if (typeof jQuery !== 'undefined') {
	jQuery(function ($) {
		$(".btn-6")
			.on("mouseenter", function (e) {
				var parentOffset = $(this).offset(),
					relX = e.pageX - parentOffset.left,
					relY = e.pageY - parentOffset.top;
				$(this).find("span").css({ top: relY, left: relX });
			})
			.on("mouseout", function (e) {
				var parentOffset = $(this).offset(),
					relX = e.pageX - parentOffset.left,
					relY = e.pageY - parentOffset.top;
				$(this).find("span").css({ top: relY, left: relX });
			});
	});
} else {
	console.warn('jQuery is not loaded');
}
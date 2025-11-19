(function ($) {
  const state = {
    page: 1,
    per_page: parseInt($("#fd-per-page").val(), 10) || 12,
    q: "",
    category: "",
    state: "",
    investment: "",
    budget: "",
    financing: "",
    busy: false,
  };

  const csrf = FRANCHISE_DIR?.nonce || "";
  const $grid = $("#fd-grid");
  const $info = $("#fd-pagination-info");
  const $pagerWrap = $("#fd-pagination-wrap");
  const $pager = $("#fd-pagination");

  function setBusy(b) {
    state.busy = !!b;
    $grid.toggleClass("is-loading", state.busy);
  }

  function collectFilters() {
    state.q = $("#fd-search").val().trim();
    state.category = $("#fd-category").val() || "";
    state.state = $("#fd-state").val() || "";
    state.investment = $("#fd-investment").val() || "";
    state.budget = $("#fd-budget").val() || "";
  }

  function rebuildPagination(page, pages) {
    if (!pages || pages < 2) {
      $pager.empty();
      return;
    }
    let html = `<button class="franchise-directory__pagination-button" data-page="prev">‹</button>`;
    for (let i = 1; i <= pages; i++) {
      const active =
        i === page ? "franchise-directory__pagination-button--active" : "";
      html += `<button class="franchise-directory__pagination-button ${active}" data-page="${i}">${i}</button>`;
    }
    html += `<button class="franchise-directory__pagination-button" data-page="next">›</button>`;
    $pager.html(html);
    $pagerWrap.attr("data-pages", pages);
  }

  function updateInfo(from, to, total) {
    $info.text(`${from} - ${to} of ${total} results`);
  }

  function fetchResults(goToPage = 1) {
    if (state.busy) return;
    setBusy(true);

    state.page = goToPage;
    collectFilters();

    $.ajax({
      url: FRANCHISE_DIR.ajax_url,
      method: "POST",
      dataType: "json",
      data: {
        action: "franchise_filter",
        nonce: csrf,
        page: state.page,
        per_page: state.per_page,
        q: state.q,
        category: state.category,
        state: state.state,
        investment: state.investment,
        budget: state.budget,
        financing: state.financing,
      },
    })
      .done(function (res) {
        if (!res || !res.success) return;
        const d = res.data;
        $grid.html(d.html);
        updateInfo(d.pagination.from, d.pagination.to, d.total);
        rebuildPagination(d.page, d.pages);
        $("#fd-current-page").val(d.page);
      })
      .always(function () {
        setBusy(false);
      });
  }

  // 🔹 Trigger on dropdown change
  $("#fd-category, #fd-state, #fd-investment").on("change", function () {
    fetchResults(1);
  });

  // 🔹 Search box (enter key)
  $("#fd-search").on("keypress", function (e) {
    if (e.which === 13) {
      e.preventDefault();
      fetchResults(1);
    }
  });

  // 🔹 Search button click
  $("#fd-search-btn").on("click", function (e) {
    e.preventDefault();
    fetchResults(1);
  });

  // 🔹 Pagination click
  $(document).on(
    "click",
    "#fd-pagination .franchise-directory__pagination-button",
    function () {
      const v = $(this).data("page");
      const current = parseInt($("#fd-current-page").val(), 10) || 1;
      let next = current;

      if (v === "prev") next = Math.max(1, current - 1);
      else if (v === "next") {
        const max =
          parseInt($("#fd-pagination-wrap").data("pages"), 10) || current;
        next = Math.min(max, current + 1);
      } else {
        next = parseInt(v, 10) || 1;
      }

      fetchResults(next);
    }
  );
})(jQuery);
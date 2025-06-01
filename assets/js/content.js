document.addEventListener("DOMContentLoaded", () => {
  // Disable text selection
  if (copyblocker_pro.disable_selection) {
    document.body.style.cssText +=
      ";user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;";
  }

  // Block copy (Ctrl+C / Cmd+C)
  if (copyblocker_pro.block_copy) {
    document.addEventListener("copy", (e) => {
      e.preventDefault();
      alert(copyblocker_pro.copy_alert);
    });
  }

  // Block paste (Ctrl+V / Cmd+V)
  if (copyblocker_pro.block_copy) {
    document.addEventListener("paste", (e) => {
      e.preventDefault();
      alert(copyblocker_pro.copy_alert);
    });
  }

  // Block select all (Ctrl+A / Cmd+A)
  if (copyblocker_pro.block_select_all) {
    document.addEventListener("keydown", (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key === "a") {
        e.preventDefault();
      }
    });
  }

  // Block developer tools (Ctrl+Shift+I / Cmd+Opt+I)
  if (copyblocker_pro.block_dev_tools) {
    document.addEventListener("keydown", (e) => {
      if (
        (e.ctrlKey && e.shiftKey && e.key === "I") ||
        (e.metaKey && e.altKey && e.key === "i")
      ) {
        e.preventDefault();
        alert(copyblocker_pro.dev_tools_alert);
      }
    });
    // Attempt to detect dev tools opening (basic approach)
    window.addEventListener("resize", () => {
      if (
        window.outerWidth - window.innerWidth > 150 ||
        window.outerHeight - window.innerHeight > 150
      ) {
        alert(copyblocker_pro.dev_tools_alert);
      }
    });
  }

  // Block context menu
  if (copyblocker_pro.block_context_menu) {
    document.addEventListener("contextmenu", (e) => {
      e.preventDefault();
    });
  }
});

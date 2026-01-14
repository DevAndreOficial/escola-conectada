// Global JavaScript - Sistema Escolar

console.log("[v0] Sistema Escolar carregado")

// Carregar componentes globais (header, navbar, footer)
document.addEventListener("DOMContentLoaded", () => {
  console.log("[v0] Inicializando componentes globais")

  loadHeader()
  loadNavbar()
  loadFooter()
  initializeNavigation()
})

// Carrega o header
function loadHeader() {
  const headerContainer = document.getElementById("header-container")
  if (headerContainer) {
    fetch("../../views/global/header.html")
      .then((response) => response.text())
      .then((html) => {
        headerContainer.innerHTML = html
        const userEmail = localStorage.getItem("userEmail")
        const userNameEl = document.getElementById("user-name")
        if (userNameEl && userEmail) {
          userNameEl.textContent = userEmail.split("@")[0]
        }
      })
      .catch((err) => console.log("[v0] Erro ao carregar header:", err))
  }
}

// Carrega a navbar
function loadNavbar() {
  const navbarContainer = document.getElementById("navbar-container")
  if (navbarContainer) {
    fetch("../../views/global/navbar.html")
      .then((response) => response.text())
      .then((html) => {
        navbarContainer.innerHTML = html
        populateNavbar()
      })
      .catch((err) => console.log("[v0] Erro ao carregar navbar:", err))
  }
}

// Popula a navbar com os itens corretos baseado no tipo de utilizador
function populateNavbar() {
  const userType = localStorage.getItem("userType")
  const navbarMenu = document.getElementById("navbar-menu")

  if (!navbarMenu) return

  let menuItems = []

  switch (userType) {
    case "professor":
      menuItems = [
        { name: "Dashboard", link: "dashboard.html" },
        { name: "Turmas", link: "listar-turmas.html" },
        { name: "Alunos", link: "listar-alunos.html" },
        { name: "Relatórios", link: "relatorios.html" },
      ]
      break
    case "encarregado":
      menuItems = [
        { name: "Dashboard", link: "dashboard.html" },
        { name: "Notas", link: "ver-notas.html" },
        { name: "Frequência", link: "ver-frequencia.html" },
      ]
      break
    case "admin":
      menuItems = [
        { name: "Dashboard", link: "dashboard.html" },
        { name: "Professores", link: "gerir-professores.html" },
        { name: "Turmas", link: "gerir-turmas.html" },
        { name: "Alunos", link: "gerir-alunos.html" },
      ]
      break
  }

  navbarMenu.innerHTML = menuItems
    .map((item) => `<li class="nav-item"><a class="nav-link" href="${item.link}">${item.name}</a></li>`)
    .join("")
}

// Carrega o footer
function loadFooter() {
  const footerContainer = document.getElementById("footer-container")
  if (footerContainer) {
    fetch("../../views/global/footer.html")
      .then((response) => response.text())
      .then((html) => {
        footerContainer.innerHTML = html
      })
      .catch((err) => console.log("[v0] Erro ao carregar footer:", err))
  }
}

// Inicializa navegação e comportamentos
function initializeNavigation() {
  console.log("[v0] Navegação inicializada")
}

// Sidebar toggle and modal wiring for index.html
document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle")
  const sidebar = document.getElementById("sidebar")
  const closeSidebar = document.getElementById("close-sidebar")
  const openCreate = document.getElementById("open-create")

  if (menuToggle && sidebar) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("open")
    })
  }

  if (closeSidebar && sidebar) {
    closeSidebar.addEventListener("click", () => {
      sidebar.classList.remove("open")
    })
  }

  // Modal open
  if (openCreate) {
    openCreate.addEventListener("click", () => {
      const createModal = new bootstrap.Modal(document.getElementById("createModal"))
      createModal.show()
    })
  }

  // Login form handling on index
  const loginForm = document.getElementById("login-form")
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault()
      const profile = document.getElementById("profile").value
      const email = document.getElementById("email").value
      // Save to localStorage and redirect to a dashboard placeholder
      localStorage.setItem("userType", profile)
      localStorage.setItem("userEmail", email)

      // Simple redirect logic — map to views folder if exists
      let base = "views/"
      switch (profile) {
        case "professor":
          window.location.href = base + "professores/dashboard.html"
          break
        case "encarregado":
          window.location.href = base + "encarregados/dashboard.html"
          break
        case "admin":
          window.location.href = base + "administracao/dashboard.html"
          break
        default:
          window.location.reload()
      }
    })
  }

  // Create modal submission
  const createSubmit = document.getElementById("create-submit")
  if (createSubmit) {
    createSubmit.addEventListener("click", () => {
      const name = document.getElementById("create-name").value
      const desc = document.getElementById("create-desc").value
      console.log("Criar:", { name, desc })
      const modalEl = document.getElementById("createModal")
      const modal = bootstrap.Modal.getInstance(modalEl)
      if (modal) modal.hide()
      // In a real app, send to API. For demo, show an alert
      alert("Item criado: " + name)
    })
  }
})

// Função para pesquisa em tabelas - Vanilla JavaScript
function setupTableSearch(searchInputId, tableId) {
  const searchInput = document.getElementById(searchInputId)
  const table = document.getElementById(tableId)

  if (searchInput && table) {
    searchInput.addEventListener("keyup", function () {
      const searchTerm = this.value.toLowerCase()
      const rows = table.querySelectorAll("tbody tr")

      rows.forEach((row) => {
        const text = row.textContent.toLowerCase()
        row.style.display = text.includes(searchTerm) ? "" : "none"
      })
    })
  }
}

// Função auxiliar para logout
function logout() {
  localStorage.removeItem("userEmail")
  localStorage.removeItem("userType")
  window.location.href = "../../index.html"
}

// Global JavaScript - Escola Conectada

document.addEventListener("DOMContentLoaded", () => {
  const userType = localStorage.getItem("userType")
  const isLoginPage = !userType && !document.getElementById("sidebar")

  if (isLoginPage) {
    initializeLogin()
  } else {
    loadHeader()
    initializeNavigation()
    initializeSidebarToggle()
  }
})

// ==================== LOGIN ==================== 
function initializeLogin() {
  const loginForm = document.getElementById("login-form")
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault()
      const profile = document.getElementById("profile").value
      const email = document.getElementById("email").value

      if (profile && email) {
        localStorage.setItem("userType", profile)
        localStorage.setItem("userEmail", email)
        
        const dashboardPath = {
          aluno: "views/aluno/dashboard.html",
          professor: "views/professores/dashboard.html",
          encarregado: "views/encarregados/dashboard.html",
          admin: "views/administracao/dashboard.html"
        }
        window.location.href = dashboardPath[profile] || "index.html"
      } else {
        alert("Por favor, preencha todos os campos")
      }
    })
  }
}

// ==================== HEADER ==================== 
function loadHeader() {
  const headerContainer = document.getElementById("header-container")
  if (headerContainer) {
    const path = window.location.pathname
    const isInSubfolder = path.includes('/views/')
    const headerPath = isInSubfolder ? "../../views/global/header.html" : "views/global/header.html"
    
    fetch(headerPath)
      .then((response) => {
        if (!response.ok) throw new Error(`Erro ao carregar header: ${response.status}`)
        return response.text()
      })
      .then((html) => {
        headerContainer.innerHTML = html
        updateUserInfo()
        setupToggleButtons()
      })
      .catch((err) => console.error("[Erro] Falha ao carregar header:", err))
  }
}

// Atualizar informações do utilizador
function updateUserInfo() {
  const userEmail = localStorage.getItem("userEmail")
  const userNameEl = document.getElementById("user-name")
  const userAvatarEl = document.getElementById("user-avatar")

  if (userEmail) {
    const userName = userEmail.split("@")[0]
    if (userNameEl) userNameEl.textContent = userName
    if (userAvatarEl) userAvatarEl.textContent = userName.charAt(0).toUpperCase()
  }
}

// ==================== SIDEBAR TOGGLE ==================== 
function initializeSidebarToggle() {
  setupToggleButtons()
}

function setupToggleButtons() {
  const sidebarToggleBtn = document.getElementById("sidebar-toggle-btn")
  const sidebar = document.getElementById("sidebar")
  const mainContent = document.querySelector(".main-content")

  if (!sidebarToggleBtn || !sidebar || !mainContent) return

  // Toggle: fechar/abrir sidebar
  sidebarToggleBtn.addEventListener("click", (e) => {
    e.preventDefault()
    e.stopPropagation()
    
    const isHidden = sidebar.classList.contains("hidden")
    
    if (isHidden) {
      // Abrir sidebar
      sidebar.classList.remove("hidden")
      mainContent.classList.remove("full-width")
      document.body.style.overflow = "auto"
    } else {
      // Fechar sidebar
      sidebar.classList.add("hidden")
      mainContent.classList.add("full-width")
    }
  })

  // Fechar sidebar ao clicar fora (em mobile)
  document.addEventListener("click", (e) => {
    const isClickInsideSidebar = sidebar.contains(e.target)
    const isClickOnButton = sidebarToggleBtn.contains(e.target)
    
    if (!isClickInsideSidebar && !isClickOnButton && window.innerWidth <= 768) {
      if (!sidebar.classList.contains("hidden")) {
        sidebar.classList.add("hidden")
        mainContent.classList.add("full-width")
      }
    }
  })

  // Abrir sidebar ao clicar em um link do menu (mobile)
  const sidebarLinks = document.querySelectorAll(".sidebar-menu a")
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= 768 && sidebar.classList.contains("hidden")) {
        sidebar.classList.remove("hidden")
        mainContent.classList.remove("full-width")
      }
    })
  })

  // Reabrir sidebar se viewport aumentar para desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      sidebar.classList.remove("hidden")
      mainContent.classList.remove("full-width")
    }
  })
}

// ==================== INICIALIZAÇÃO NAVEGAÇÃO ==================== 
function initializeNavigation() {
  // Navegação inicializada
// ==================== LOGOUT ====================
function logout() {
  localStorage.removeItem("userEmail")
  localStorage.removeItem("userType")
  window.location.href = "../../index.html"
}

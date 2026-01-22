// Global JavaScript - Escola Conectada

console.log("[Sistema] Escola Conectada carregado")

// Carregar componentes globais
document.addEventListener("DOMContentLoaded", () => {
  console.log("[Sistema] Inicializando componentes globais")

  const userType = localStorage.getItem("userType")
  const isLoginPage = !userType && !document.getElementById("sidebar")

  if (isLoginPage) {
    initializeLogin()
  } else {
    loadHeader()
    initializeNavigation()
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
        
        // Redirecionar para dashboard do perfil
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
    // Determinar o caminho correto baseado na localização do arquivo
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



// ==================== INICIALIZAÇÃO NAVEGAÇÃO ==================== 
function initializeNavigation() {
  console.log("[Sistema] Navegação inicializada")
}

// ==================== LOGOUT ====================
function logout() {
  localStorage.removeItem("userEmail")
  localStorage.removeItem("userType")
  window.location.href = "http://localhost/www.escola-conectada.com/login"
}

import { useEffect, useState } from 'react'
import { exchangeCode, fetchMe } from '../lib/sso'

export default function Callback() {
  const [msg, setMsg] = useState('Memproses login...')

  useEffect(() => {
    (async () => {
      const params = new URLSearchParams(window.location.search)
      const code = params.get('code')
      const state = params.get('state')
      if (!code) {
        setMsg('Kode otorisasi tidak ditemukan.')
        return
      }
      const savedState = sessionStorage.getItem('oauth_state')
      const verifier = sessionStorage.getItem('pkce_verifier')
      sessionStorage.removeItem('oauth_state')
      if (!savedState || savedState !== state) {
        setMsg('State tidak valid.')
        return
      }
      try {
        const token = await exchangeCode({ code, codeVerifier: verifier })
        const accessToken = token.access_token
        if (!accessToken) throw new Error('Access token kosong')
        const me = await fetchMe(accessToken)
        localStorage.setItem('access_token', accessToken)
        localStorage.setItem('user', JSON.stringify(me))
        window.location.replace('/dashboard')
      } catch (e) {
        setMsg('Login SSO gagal: ' + e.message)
      }
    })()
  }, [])

  return (
    <div className="container">
      <div className="card">
        <h2>Callback</h2>
        <p className="msg err">{msg}</p>
      </div>
    </div>
  )
}

import { useEffect, useState } from 'react'
import { createPkce } from '../lib/pkce'
import { buildAuthorizeUrl } from '../lib/sso'

export default function Login() {
  const [authUrl, setAuthUrl] = useState('')
  const [error, setError] = useState('')

  useEffect(() => {
    (async () => {
      try {
        const { verifier, challenge } = await createPkce()
        const state = crypto.getRandomValues(new Uint8Array(16)).join('')
        sessionStorage.setItem('pkce_verifier', verifier)
        sessionStorage.setItem('oauth_state', state)
        const url = buildAuthorizeUrl({ state, codeChallenge: challenge })
        setAuthUrl(url)
      } catch (e) {
        setError(e.message)
      }
    })()
  }, [])

  return (
    <div className="container">
      <div className="card">
        <h2>SSO UNUGIRI Client (React)</h2>
        {error && <p className="msg err">{error}</p>}
        <p>Silakan login menggunakan akun SSO UNUGIRI.</p>
        {authUrl && (
          <p>
            <a className="btn" href={authUrl}>Login dengan SSO UNUGIRI</a>
          </p>
        )}
      </div>
    </div>
  )
}

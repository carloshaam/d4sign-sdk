<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\CreateSignatoryFieldsInterface;

class CreateSignatoryFields implements CreateSignatoryFieldsInterface
{
    private ?string $email;
    private int $act;
    private int $foreign;
    private ?string $foreignLang = null;
    private int $certificadoIcpBr;
    private int $assinaturaPresencial;
    private ?int $docAuth = null;
    private ?int $docAuthAndSelfie = null;
    private ?string $embedMethodAuth = null;
    private ?string $embedSmsNumber = null;
    private ?int $uploadAllow = null;
    private ?string $uploadObs = null;
    private ?int $afterPosition = null;
    private ?int $skipEmail = null;
    private ?string $whatsappNumber = null;
    private ?string $uuidGrupo = null;
    private ?int $certificadoIcpBrTipo = null;
    private ?string $certificadoIcpBrCpf = null;
    private ?string $certificadoIcpBrCnpj = null;
    private ?string $passwordCode = null;
    private ?int $authPix = null;
    private ?string $authPixNome = null;
    private ?string $authPixCpf = null;
    private ?int $videoselfie = null;
    private ?int $d4signScore = null;
    private ?string $d4signScoreNome = null;
    private ?string $d4signScoreCpf = null;
    private ?int $d4signScoreSimilarity = null;

    public function __construct(
        string $email,
        int $act,
        int $foreign = 0,
        int $certificadoIcpBr = 0,
        int $assinaturaPresencial = 0
    ) {
        $this->setEmail($email);
        $this->setAct($act);
        $this->setForeign($foreign);
        $this->setCertificadoIcpBr($certificadoIcpBr);
        $this->setAssinaturaPresencial($assinaturaPresencial);
    }

    public function setEmail(?string $email): self
    {
        if ($email !== null && ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O e-mail '$email' não é válido.");
        }

        $this->email = $email;

        return $this;
    }

    public function setAct(int $act): self
    {
        $this->act = $act;

        return $this;
    }

    public function setForeign(int $foreign): self
    {
        if (! in_array($foreign, [0, 1], true)) {
            throw new D4SignInvalidArgumentException("Valor inválido para 'foreign': $foreign. Esperado: '0' ou '1'.");
        }

        $this->foreign = $foreign;

        return $this;
    }

    public function setCertificadoIcpBr(int $certificadoIcpBr): self
    {
        if (! in_array($certificadoIcpBr, [0, 1], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'certificadoIcpBr': $certificadoIcpBr. Esperado: '0' ou '1'.",
            );
        }

        $this->certificadoIcpBr = $certificadoIcpBr;

        return $this;
    }

    public function setAssinaturaPresencial(int $assinaturaPresencial): self
    {
        if (! in_array($assinaturaPresencial, [0, 1], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'assinaturaPresencial': $assinaturaPresencial. Esperado: '0' ou '1'.",
            );
        }

        $this->assinaturaPresencial = $assinaturaPresencial;

        return $this;
    }

    public function setDocAuth(int $docAuth): self
    {
        if (! in_array($docAuth, [0, 1], true)) {
            throw new D4SignInvalidArgumentException("Valor inválido para 'docAuth': $docAuth. Esperado: '0' ou '1'.");
        }

        $this->docAuth = $docAuth;

        return $this;
    }

    public function setDocAuthAndSelfie(int $docAuthAndSelfie): self
    {
        if (! in_array($docAuthAndSelfie, [0, 1], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'docAuthAndSelfie': $docAuthAndSelfie. Esperado: '0' ou '1'.",
            );
        }

        $this->docAuthAndSelfie = $docAuthAndSelfie;

        return $this;
    }

    public function setEmbedMethodAuth(string $embedMethodAuth): self
    {
        if (! in_array($embedMethodAuth, ['email', 'password', 'sms', 'whats'], true)) {
            throw new D4SignInvalidArgumentException(
                "Método de autenticação inválido: $embedMethodAuth. Esperado: 'email', 'password', 'sms' ou 'whats'.",
            );
        }

        $this->embedMethodAuth = $embedMethodAuth;

        return $this;
    }

    public function setEmbedSmsNumber(?string $embedSmsNumber): self
    {
        if ($embedSmsNumber !== null && ! preg_match('/^\+\d{11,15}$/', $embedSmsNumber)) {
            throw new D4SignInvalidArgumentException(
                "Número de autenticação inválido: '$embedSmsNumber'. Deve estar no formato internacional, incluindo o código do país.",
            );
        }

        $this->embedSmsNumber = $embedSmsNumber;

        return $this;
    }

    public function setUploadDocument(string $obs): self
    {
        $this->setUploadAllow();
        $this->setUploadObs($obs);

        return $this;
    }

    private function setUploadAllow(): void
    {
        $this->uploadAllow = 1;
    }

    private function setUploadObs(string $uploadObs): void
    {
        $this->uploadObs = $uploadObs;
    }

    public function setForeignLang(?string $foreignLang): self
    {
        if ($foreignLang !== null && ! in_array($foreignLang, ['en', 'es', 'ptBR'], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'foreignLang'. Deve ser 'en' = Inglês (US), 'es' = Espanhol ou 'ptBR' = Português.",
            );
        }

        $this->foreignLang = $foreignLang;

        return $this;
    }

    public function setAfterPosition(?int $afterPosition): self
    {
        if (! in_array($afterPosition, [0, 1], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'afterPosition': $afterPosition. Esperado: '0' ou '1'.",
            );
        }

        $this->afterPosition = $afterPosition;

        return $this;
    }

    public function setSkipEmail(?int $skipEmail): self
    {
        if ($skipEmail !== null && ! in_array($skipEmail, [0, 1], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'skipEmail'. Deve ser 0  ou 1.",
            );
        }

        $this->skipEmail = $skipEmail;

        return $this;
    }

    public function setWhatsappNumber(?string $whatsappNumber): self
    {
        if ($this->email !== null || $this->uuidGrupo !== null) {
            throw new D4SignInvalidArgumentException(
                'E-mail e UUID do Grupo não devem ser enviados.',
            );
        }

        if ($whatsappNumber !== null && ! preg_match('/^\+\d{11,15}$/', $whatsappNumber)) {
            throw new D4SignInvalidArgumentException(
                "Número de WhatsApp inválido: '$whatsappNumber'. Deve estar no formato internacional, incluindo o código do país.",
            );
        }

        $this->whatsappNumber = $whatsappNumber;

        return $this;
    }

    public function setUuidGrupo(?string $uuidGrupo): self
    {
        if ($uuidGrupo !== null && (strlen($uuidGrupo) !== 36 || ! preg_match('/^[a-f0-9\-]{36}$/', $uuidGrupo))) {
            throw new D4SignInvalidArgumentException(
                "UUID do grupo inválido: '$uuidGrupo'. Deve ter 36 caracteres no formato UUID.",
            );
        }

        $this->uuidGrupo = $uuidGrupo;

        return $this;
    }

    public function setCertificadoIcpBrTipo(?int $certificadoIcpBrTipo): self
    {
        if ($certificadoIcpBrTipo !== null && ! in_array($certificadoIcpBrTipo, [1, 2, 3], true)) {
            throw new D4SignInvalidArgumentException(
                "Valor inválido para 'certificadoIcpBrTipo'. Deve ser 1 (Qualquer), 2 (e-CPF) ou 3 (e-CNPJ).",
            );
        }

        $this->certificadoIcpBrTipo = $certificadoIcpBrTipo;

        return $this;
    }

    public function setCertificadoIcpBrCpf(?string $certificadoIcpBrCpf): self
    {
        if ($certificadoIcpBrCpf !== null && ! preg_match('/^\d{11}$/', $certificadoIcpBrCpf)) {
            throw new D4SignInvalidArgumentException(
                "CPF inválido: '$certificadoIcpBrCpf'. Deve ter 11 dígitos para 'certificadoIcpBrCpf' ou deixe em branco.",
            );
        }

        $this->certificadoIcpBrCpf = $certificadoIcpBrCpf;

        return $this;
    }

    public function setCertificadoIcpBrCnpj(?string $certificadoIcpBrCnpj): self
    {
        if ($certificadoIcpBrCnpj !== null && ! preg_match('/^\d{14}$/', $certificadoIcpBrCnpj)) {
            throw new D4SignInvalidArgumentException(
                "CNPJ inválido: '$certificadoIcpBrCnpj'. Deve ter 14 dígitos para 'certificadoIcpBrCnpj' ou deixe em branco.",
            );
        }

        $this->certificadoIcpBrCnpj = $certificadoIcpBrCnpj;

        return $this;
    }

    public function setPasswordCode(?string $passwordCode): self
    {
        if ($passwordCode !== null && strlen($passwordCode) < 4) {
            throw new D4SignInvalidArgumentException(
                "O código de acesso 'password_code' deve ter pelo menos 4 caracteres ou deixe em branco para remover.",
            );
        }

        $this->passwordCode = $passwordCode;

        return $this;
    }

    public function setExtraAuthPix(string $nome, string $cpf): self
    {
        $this->setAuthPix();
        $this->setAuthPixNome($nome);
        $this->setAuthPixCpf($cpf);

        return $this;
    }

    private function setAuthPix(): void
    {
        $this->authPix = 1;
    }

    private function setAuthPixNome(string $authPixNome): void
    {
        if (strlen($authPixNome) === 0) {
            throw new D4SignInvalidArgumentException("O 'nome' é obrigatório quando 'auth_pix' é 1.");
        }

        $this->authPixNome = $authPixNome;
    }

    private function setAuthPixCpf(string $authPixCpf): void
    {
        if (! preg_match('/^\d{11}$/', $authPixCpf)) {
            throw new D4SignInvalidArgumentException(
                "O CPF do 'authPixCpf' é obrigatório e deve conter 11 dígitos numéricos quando 'auth_pix' é 1.",
            );
        }

        $this->authPixCpf = $authPixCpf;
    }

    public function setVideoselfie(?int $videoselfie): self
    {
        if ($videoselfie !== null && ! in_array($videoselfie, [0, 1], true)) {
            throw new D4SignInvalidArgumentException("Valor inválido para 'videoselfie'. Deve ser 0 ou 1.");
        }

        $this->videoselfie = $videoselfie;

        return $this;
    }

    public function setD4signScoreDenatran(string $nome, string $cpf, int $similaridade): self
    {
        if ($this->docAuthAndSelfie !== 1 && $this->videoselfie !== 1) {
            throw new D4SignInvalidArgumentException("Parâmetros 'docauthandselfie' ou 'videoselfie' obrigatório.");
        }

        $this->setD4signScore();
        $this->setD4signScoreNome($nome);
        $this->setD4signScoreCpf($cpf);
        $this->setD4signScoreSimilarity($similaridade);

        return $this;
    }

    private function setD4signScore(): void
    {
        $this->d4signScore = 1;
    }

    private function setD4signScoreNome(string $d4signScoreNome): void
    {
        if (strlen($d4signScoreNome) === 0) {
            throw new D4SignInvalidArgumentException(
                "O nome do 'd4sign_score_nome' é obrigatório quando 'd4sign_score' é 1.",
            );
        }

        $this->d4signScoreNome = $d4signScoreNome;
    }

    private function setD4signScoreCpf(string $d4signScoreCpf): void
    {
        if (! preg_match('/^\d{11}$/', $d4signScoreCpf)) {
            throw new D4SignInvalidArgumentException(
                "O CPF do 'd4sign_score_cpf' é obrigatório (11 dígitos) quando 'd4sign_score' é 1.",
            );
        }

        $this->d4signScoreCpf = $d4signScoreCpf;
    }

    private function setD4signScoreSimilarity(int $d4signScoreSimilarity): void
    {
        if ($d4signScoreSimilarity < 70 || $d4signScoreSimilarity > 90) {
            throw new D4SignInvalidArgumentException(
                "O nível de similaridade ('d4sign_score_similarity') deve estar entre 70 e 90.",
            );
        }

        $this->d4signScoreSimilarity = $d4signScoreSimilarity;
    }

    public function toArray(): array
    {
        $data = [
            'email' => $this->email,
            'act' => $this->act,
            'foreign' => $this->foreign,
            'certificadoicpbr' => $this->certificadoIcpBr,
            'assinatura_presencial' => $this->assinaturaPresencial,
        ];

        if ($this->docAuth !== null) {
            $data['docauth'] = $this->docAuth;
        }

        if ($this->docAuthAndSelfie !== null) {
            $data['docauthandselfie'] = $this->docAuthAndSelfie;
        }

        if ($this->embedMethodAuth !== null) {
            $data['embed_methodauth'] = $this->embedMethodAuth;
        }

        if ($this->embedSmsNumber !== null) {
            $data['embed_smsnumber'] = $this->embedSmsNumber;
        }

        if ($this->uploadAllow !== null) {
            $data['upload_allow'] = $this->uploadAllow;
        }

        if ($this->uploadObs !== null) {
            $data['upload_obs'] = $this->uploadObs;
        }

        if ($this->afterPosition !== null) {
            $data['after_position'] = $this->afterPosition;
        }

        if ($this->skipEmail !== null) {
            $data['skipemail'] = $this->skipEmail;
        }

        if ($this->whatsappNumber !== null) {
            $data['whatsapp_number'] = $this->whatsappNumber;
        }

        if ($this->uuidGrupo !== null) {
            $data['uuid_grupo'] = $this->uuidGrupo;
        }

        if ($this->foreignLang !== null) {
            $data['foreign_lang'] = $this->foreignLang;
        }

        if ($this->certificadoIcpBrTipo !== null) {
            $data['certificadoicpbr_tipo'] = $this->certificadoIcpBrTipo;
        }

        if ($this->certificadoIcpBrCpf !== null) {
            $data['certificadoicpbr_cpf'] = $this->certificadoIcpBrCpf;
        }

        if ($this->certificadoIcpBrCnpj !== null) {
            $data['certificadoicpbr_cnpj'] = $this->certificadoIcpBrCnpj;
        }

        if ($this->passwordCode !== null) {
            $data['password_code'] = $this->passwordCode;
        }

        if ($this->authPix !== null) {
            $data['auth_pix'] = $this->authPix;
        }

        if ($this->authPixNome !== null) {
            $data['auth_pix_nome'] = $this->authPixNome;
        }

        if ($this->authPixCpf !== null) {
            $data['auth_pix_cpf'] = $this->authPixCpf;
        }

        if ($this->videoselfie !== null) {
            $data['videoselfie'] = $this->videoselfie;
        }

        if ($this->d4signScore !== null) {
            $data['d4sign_score'] = $this->d4signScore;
        }

        if ($this->d4signScoreNome !== null) {
            $data['d4sign_score_nome'] = $this->d4signScoreNome;
        }

        if ($this->d4signScoreCpf !== null) {
            $data['d4sign_score_cpf'] = $this->d4signScoreCpf;
        }

        if ($this->d4signScoreSimilarity !== null) {
            $data['d4sign_score_similarity'] = $this->d4signScoreSimilarity;
        }

        return $data;
    }
}

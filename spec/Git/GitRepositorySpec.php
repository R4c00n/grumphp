use Gitonomy\Git\Exception\ProcessException;
use Symfony\Component\Process\Process;
    public function it_can_deal_with_errornous_throwing_runs(Process $process): void
    {
        $this->tryToRunWithFallback(
            function () use ($process) {
                throw new ProcessException($process->getWrappedObject());
            },
            'fallback'
        )->shouldBe('fallback');
    }

    public function it_can_deal_with_errornous_null_returing_runs(): void
    {
        $this->tryToRunWithFallback(
            function () {
                return null;
            },
            'fallback'
        )->shouldBe('fallback');
    }

    public function it_can_deal_with_valid_run_results(): void
    {
        $this->tryToRunWithFallback(
            function () {
                return 'ok';
            },
            'fallback'
        )->shouldBe('ok');
    }
